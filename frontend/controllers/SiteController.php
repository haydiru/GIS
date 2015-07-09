<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Response;

/**
* Site controller
*/
class SiteController extends Controller
{
	/**
	* @inheritdoc
	*/
	public function behaviors()
	{
		return [
		'access' => [
		'class' => AccessControl::className(),
		'only' => ['logout', 'signup'],
		'rules' => [
		[
		'actions' => ['signup'],
		'allow' => true,
		'roles' => ['?'],
		],
		[
		'actions' => ['logout'],
		'allow' => true,
		'roles' => ['@'],
		],
		],
		],
		'verbs' => [
		'class' => VerbFilter::className(),
		'actions' => [
		'logout' => ['post'],
		],
		],
		];
	}

	/**
	* @inheritdoc
	*/
	public function actions()
	{
		return [
		'error' => [
		'class' => 'yii\web\ErrorAction',
		],
		'captcha' => [
		'class' => 'yii\captcha\CaptchaAction',
		'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
		],
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
			'model' => $model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending email.');
			}

			return $this->refresh();
		} else {
			return $this->render('contact', [
			'model' => $model,
			]);
		}
	}

	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($user = $model->signup()) {
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}

		return $this->render('signup', [
		'model' => $model,
		]);
	}

	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

				return $this->goHome();
			} else {
				Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
			}
		}

		return $this->render('requestPasswordResetToken', [
		'model' => $model,
		]);
	}

	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->getSession()->setFlash('success', 'New password was saved.');

			return $this->goHome();
		}

		return $this->render('resetPassword', [
		'model' => $model,
		]);
	}
	public function actionData($wil,$var){
		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		Yii::$app->response->format = 'jsongis';
		$query = new Query;
			$query->select('wilayah.id ,wilayah.nama,fakta.nilai,fakta.tahun,variabel.satuan,fakta.id_bulan,bulan.nama')
			->from('fakta')
			->distinct('wilayah.id ,wilayah.nama,fakta.nilai,fakta.tahun,variabel.satuan,fakta.id_bulan,bulan.nama')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'topik','variabel.id_topik=topik.id')
			->join('INNER JOIN', 'bulan','fakta.id_bulan=bulan.id')
			->where('wilayah.tipe='.$wil.' AND variabel.id='.$var);
		$rows = $query->all();
		$command = $query->createCommand();
		$rows = $command->queryAll();
		return $rows;
	}
	public function actionChild() {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
		$id = end($_POST['depdrop_parents']);
			$query = new Query;
			$query->select('topik.nama AS namaTopik,variabel.id, variabel.nama')
			->from('fakta')
			->distinct('variabel.id')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'topik','variabel.id_topik=topik.id')
			->orderBy('topik.nama')
			->where('wilayah.tipe='.$id);
			$list = $query->all();
			//$list = \common\models\Fakta::findBySql('SELECT DISTINCT id_variabel FROM fakta')->asArray()->all();
			//SELECT DISTINCT topik.id, topik.nama FROM fakta
//RIGHT JOIN topik ON fakta.id_variabel=topik.id
			$selected  = null;
			if ($id != null && count($list) > 0) {
				$selected = '';
				foreach ($list as $i => $variabel) {$topik[$i]=$variabel['namaTopik'];
					//$namaVariabel=\frontend\models\Variabel::find()->andWhere(['kode'=>$account['kode_variabel']])->asArray()->all();
					$out[$variabel['namaTopik']][] = ['id' => $variabel['id'], 'name' => $variabel['nama']];
					if ($i == 0) {
						$selected = $variabel['id'];
					}
				}
				// Shows how you can preselect a value
				return (['output' => $out, 'selected'=>$selected]);
				
			}
		}
		return (['output' => '', 'selected'=>'']);
	}
	public function actionChildVariabel() {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$id = end($_POST['depdrop_parents']);
			$id2 = $_POST['Wilayah']['nama'];
			$query = new Query;
			$query->select('variabel.id, variabel.nama')
			->from('fakta')
			->distinct('variabel.id')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'topik','variabel.id_topik=topik.id')
			->where('topik.id='.$id.'AND wilayah.tipe='.$id2);
			$list = $query->all();
			$selected  = null;
			if ($id != null && count($list) > 0) {
				$selected = '';
				foreach ($list as $i => $account) {
					//$namaVariabel=\frontend\models\Variabel::find()->andWhere(['kode'=>$account['kode_variabel']])->asArray()->all();
					//$wilayah = \common\models\Wilayah::findOne(['id' => $account['id_wilayah'],]);
					$out[] = ['id' => $account['id'], 'name' => $account['nama']];
					if ($i == 0) {
						$selected = $account['id'];
					}
				}
				// Shows how you can preselect a value
				return (['output' => $out, 'selected'=>$selected]);
				
			}
		}
		return (['output' => '', 'selected'=>'']);
	}
	public function beforeAction($action) {
		$this->enableCsrfValidation = false; // <-- here
		return parent::beforeAction($action);
	}

	public function actionExcel() {
		$objPHPExcel = \PHPExcel_IOFactory::load('alokasi kamar.xls');
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		print_r($sheetData);
	}

}
