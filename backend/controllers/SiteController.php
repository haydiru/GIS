<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\UploadForm;
use yii\web\UploadedFile;

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
		'access'=>[
		'class'=>AccessControl::className(),
		'rules'=>[
		[
		'actions'=>['login','error'],
		'allow'=>true,
		],
		[
		'actions'=>['logout','index','download','upload','child'],
		'allow'=>true,
		'roles'=>['@'],
		],
		],
		],
		'verbs'=>[
		'class'=>VerbFilter::className(),
		'actions'=>[
		'logout'=>['post'],
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
		'error'=>[
		'class'=>'yii\web\ErrorAction',
		],
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}
	
	public function actionUpload()
	{
		$model=new UploadForm();

		if(Yii::$app->request->isPost){
			$model->file=UploadedFile::getInstance($model,'file');

			if($model->validate()){
				$model->file->saveAs('uploads/'.$model->file->baseName.'.'.$model->file->extension);
				
				$objReader=\PHPExcel_IOFactory::createReader('Excel5');
				$objPHPExcel=$objReader->load('uploads/'.$model->file->baseName.'.'.$model->file->extension);
				$fakta=new \common\models\Fakta();
				$variabel=new \common\models\Variabel();
				$topik=new \common\models\Topik();
				$bulan=new \common\models\Bulan();
				$wilayah=new \common\models\Wilayah();
				$kategori=new \common\models\Kategori();
				$itemKategori=new \common\models\ItemKategori();
				$highestColumm=\PHPExcel_Cell::columnIndexFromString($objPHPExcel->setActiveSheetIndex(0)->getHighestColumn());// e.g. "EL"
				$highestRow=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				$sumberData=new \common\models\SumberData;
				$topik_=null;
				$variabel_=null;
				$tahun_=null;
				$bulan_=null;
				$itemKategori_=null;
				$satuan_=null;
				$sumberData_=$sumberData::findOne(['nama_cs'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,1)->getValue(),])['id'];
				if($sumberData_==null){
					$sumberData->nama_cs=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,1)->getValue();
					$sumberData->insert();
					$sumberData_=$sumberData::findOne(['nama_cs'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,1)->getValue(),])['id'];
				}
				for($i=6;$i<=$highestRow;$i++){
					for($j=0;$j<$highestColumm;$j++){
						if($j==0){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$topik_=$topik::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								if($topik_==null){
									$topik_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
									\Yii::$app->db->createCommand()->insert('topik',[
									'nama'=>$topik_,
									'id_parent'=>0,
									'keterangan'=>'tes',
									])->execute();
									$topik_=$topik::findOne(['nama'=>$topik_,])['id'];
								}
							}
						}
						else if($j==1){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$tahun_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
							}
							else {echo "harus ada tahun";}
						}
						else if($j==2){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$bulan_=$bulan::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								if($bulan_== null){
									$bulan_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
									\Yii::$app->db->createCommand()->insert('bulan',[
									'nama'=>$bulan_,
									])->execute();
									$bulan_=$bulan::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								}
							}
							else $bulan_=0;
						}
						else if($j==3){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$satuan_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
							}
							else $satuan_='tidak ada satuan';
						}
						else if($j==4){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$variabel_=$variabel::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								if($variabel_==null){
									$variabel_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
									\Yii::$app->db->createCommand()->insert('variabel',[
									'nama'=>$variabel_,
									'id_topik'=>$topik_,
									'satuan'=>$satuan_,
									'keterangan'=>'tes',
									])->execute();
									$variabel_=$variabel::findOne(['nama'=>$variabel_,])['id'];
								}
							}
						}

						else if($j==5){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$kategori_=$kategori::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								if($kategori_==null){
									$kategori_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
									\Yii::$app->db->createCommand()->insert('kategori',[
									'nama'=>$kategori_,
									'id_variabel'=>$variabel_,
									])->execute();
									$kategori_=$kategori::findOne(['nama'=>$kategori_,])['id'];
								}
							}
							else $kategori_=0;
						}
						else {
							$idParent = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,1)->getValue();
							$idwilayah=$wilayah::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,5)->getValue(),'id_parent'=>$idParent,])['id'];
							\Yii::$app->db->createCommand()->insert('fakta',[
							'tahun'=>$tahun_,
							'nilai'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),
							'id_bulan'=>$bulan_,
							'id_wilayah'=>$idwilayah,
							'id_variabel'=>$variabel_,
							'id_kategori'=>$kategori_,
							'kode_unik'=> $idwilayah.$variabel_.$kategori_.$tahun_.$bulan_,
							'id_item_kategori'=>0,
							'id_sumber_data'=>$sumberData_,
							])->execute();
						}
					}
				}//end of baris
				unlink('uploads/'.$model->file->baseName.'.'.$model->file->extension);
				return \Yii::$app->response->redirect('?r=fakta',301)->send();
			}
		}

		return  $this->render('import',['model'=>$model]);
	}

	public function actionLogin()
	{
		if(!\Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model=new LoginForm();
		if($model->load(Yii::$app->request->post())&&$model->login()){
			return $this->goBack();
		}else{
			return $this->render('login',[
			'model'=>$model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}
	
	public function actionDownload()
	{
		
		$objReader=\PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel=$objReader->load('uploads/upload-database.xls');

		$id=$_POST['Wilayah']['nama'];

		if($id!==null){
			$list=\common\models\Wilayah::find()->andWhere(['id_parent'=>$id])->asArray()->all();
			$selected=null;
			if($id!=null&&count($list)>0){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1,$id);
				$selected='';
				$col=6;
				foreach($list as $i=>$wil){
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,5,$wil['nama']);
					$col++;
				}
				// Shows how you can preselect a value
				
			}

			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Simple');


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="upload.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');// Date in the past
			header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');// always modified
			header('Cache-Control: cache, must-revalidate');// HTTP/1.1
			header('Pragma: public');// HTTP/1.0

			$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			$objWriter->save('php://output');
			exit;
		}
	}

	public function actionChild(){
		\Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
		$out=[];
		if(isset($_POST['depdrop_parents'])){
			$id=end($_POST['depdrop_parents']);
			$list=\common\models\Wilayah::find()->andWhere(['tipe'=>$id])->asArray()->all();
			$selected=null;
			if($id!=null&&count($list)>0){
				$selected='';
				foreach($list as $i=>$account){
					$out[]=['id'=>$account['id'],'name'=>$account['nama']];
					if($i==0){
						$selected=$account['id'];
					}
				}
				// Shows how you can preselect a value
				return (['output'=>$out,'selected'=>$selected]);
				
			}
		}
		return  (['output'=>'','selected'=>'']);
	}
	
	public function beforeAction($action){
		$this->enableCsrfValidation=false;// <-- here
		return  parent::beforeAction($action);
	}
	

}