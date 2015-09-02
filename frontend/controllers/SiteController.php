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
	public function actionData($wil,$var,$kat){
		
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$namaWilparent = \common\models\Wilayah::findOne(['id' => $wil,]);
		
		$query = new Query;
			$query->select('fakta.id_wilayah, wilayah.nama as nama_wilayah, fakta.nilai, fakta.tahun, variabel.satuan, variabel.nama as nama_variabel, kategori.nama as nama_kategori, fakta.id_bulan, bulan.nama as nama_bulan')
			->from('fakta')
			->distinct('wilayah.id ,fakta.nilai,fakta.tahun,variabel.satuan,fakta.id_bulan,bulan.nama')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'bulan','fakta.id_bulan=bulan.id')
			->join('INNER JOIN', 'kategori','fakta.id_kategori=kategori.id')
			->orderBy('fakta.tahun,fakta.id_bulan')
			->where('wilayah.id_parent='.$wil.' AND fakta.id_variabel='.$var.' AND fakta.id_kategori='.$kat);
		$rows = $query->all();
		$command = $query->createCommand();
		$rows = $command->queryAll();
		return (['data'=>$rows,'namaparent'=>$namaWilparent['nama']]);
	}
		
	public function actionChildTopik() {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])&&end($_POST['depdrop_parents'])!=null) {
		$id = end($_POST['depdrop_parents']);
			$query = new Query;
			$query->select('topik.id, topik.nama')
			->from('fakta')
			->distinct('topik.id')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'topik','variabel.id_topik=topik.id')
			->orderBy('topik.nama')
			->where('wilayah.id_parent='.$id);
			$list = $query->all();
			$selected  = null;
			if ($id != null && count($list) > 0) {
				$selected = '';
				foreach ($list as $i => $topik) {
					//$topik[$i]=$variabel['namaTopik'];
					//$namaVariabel=\frontend\models\Variabel::find()->andWhere(['kode'=>$account['kode_variabel']])->asArray()->all();
					$out[] = ['id' => $id.$topik['id'], 'name' => $topik['nama']];
					if ($i == 0) {
						$selected = $id.$topik['id'];
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
		if (isset($_POST['depdrop_parents'])&&end($_POST['depdrop_parents'])!=null) {
		$id = end($_POST['depdrop_parents']);
		$l=strlen($id)-10;
		$idTop=substr($id,10,$l);
		$idWil=substr($id,0,10);
			$query = new Query;
			$query->select('variabel.id, variabel.nama')
			->from('fakta')
			->distinct('variabel.id')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'topik','variabel.id_topik=topik.id')
			->orderBy('variabel.nama')
			->where('topik.id='.$idTop.' AND wilayah.id_parent='.$idWil);
			$list = $query->all();
			//$list = \common\models\Fakta::findBySql('SELECT DISTINCT id_variabel FROM fakta')->asArray()->all();
			//SELECT DISTINCT topik.id, topik.nama FROM fakta
//RIGHT JOIN topik ON fakta.id_variabel=topik.id
			$selected  = null;
			if ($id != null && count($list) > 0) {
				$selected = '';
				foreach ($list as $i => $variabel) {
					//$topik[$i]=$variabel['namaTopik'];
					//$namaVariabel=\frontend\models\Variabel::find()->andWhere(['kode'=>$account['kode_variabel']])->asArray()->all();
					$out[] = ['id' => $idWil.$variabel['id'], 'name' => $variabel['nama']];
					if ($i == 0) {
						$selected = $idWil.$variabel['id'];
					}
				}
				// Shows how you can preselect a value
				return (['output' => $out, 'selected'=>$selected]);
				
			}
		}
		return (['output' => '', 'selected'=>'']);
	}
	
		public function actionChildKategori() {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])&&end($_POST['depdrop_parents'])!=null) {
		$id = end($_POST['depdrop_parents']);
		$l=strlen($id)-10;
		$idVar=substr($id,10,$l);
		$idWil=substr($id,0,10);
			$query = new Query;
			$query->select('kategori.id, kategori.nama')
			->from('fakta')
			->distinct('kategori.id')
			->join('INNER JOIN', 'wilayah','fakta.id_wilayah=wilayah.id')
			->join('INNER JOIN', 'variabel','fakta.id_variabel=variabel.id')
			->join('INNER JOIN', 'kategori','fakta.id_kategori=kategori.id')
			->orderBy('kategori.nama')
			->where('variabel.id='.$idVar.' AND wilayah.id_parent='.$idWil);
			$list = $query->all();
			//$list = \common\models\Fakta::findBySql('SELECT DISTINCT id_variabel FROM fakta')->asArray()->all();
			//SELECT DISTINCT topik.id, topik.nama FROM fakta
//RIGHT JOIN topik ON fakta.id_variabel=topik.id
			$selected  = null;
			if ($id != null && count($list) > 0) {
				$selected = '';
				foreach ($list as $i => $variabel) {
					//$topik[$i]=$variabel['namaTopik'];
					//$namaVariabel=\frontend\models\Variabel::find()->andWhere(['kode'=>$account['kode_variabel']])->asArray()->all();
					$out[] = ['id' => $variabel['id'], 'name' => $variabel['nama']];
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
	
		public function actionChildWilayah() {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])&&end($_POST['depdrop_parents'])!=null) {
			$id = end($_POST['depdrop_parents']);
			$query = new Query;
			$query->select('id,nama')
			->from('wilayah')
			->where('tipe='.$id);
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
}
