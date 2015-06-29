<?php
namespacebackend\controllers;

useYii;
useyii\filters\AccessControl;
useyii\web\Controller;
usecommon\models\LoginForm;
useyii\filters\VerbFilter;
usebackend\models\UploadForm;
useyii\web\UploadedFile;

/**
* Site controller
*/
classSiteControllerextendsController
{
	/**
	* @inheritdoc
	*/
	publicfunctionbehaviors()
	{
		return[
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
	publicfunctionactions()
	{
		return[
		'error'=>[
		'class'=>'yii\web\ErrorAction',
		],
		];
	}

	publicfunctionactionIndex()
	{
		return$this->render('index');
	}
	
	publicfunctionactionUpload()
	{
		$model=newUploadForm();

		if(Yii::$app->request->isPost){
			$model->file=UploadedFile::getInstance($model,'file');

			if($model->validate()){
				$model->file->saveAs('uploads/'.$model->file->baseName.'.'.$model->file->extension);
				
				$objReader=\PHPExcel_IOFactory::createReader('Excel2007');
				$objPHPExcel=$objReader->load('uploads/'.$model->file->baseName.'.'.$model->file->extension);
				$fakta=new\common\models\Fakta();
				$variabel=new\common\models\Variabel();
				$topik=new\common\models\Topik();
				$bulan=new\common\models\Bulan();
				$wilayah=new\common\models\Wilayah();
				$kategori=new\common\models\Kategori();
				$itemKategori=new\common\models\ItemKategori();
				$highestColumm=\PHPExcel_Cell::columnIndexFromString($objPHPExcel->setActiveSheetIndex(0)->getHighestColumn());// e.g. "EL"
				$highestRow=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				$sumberData=new\common\models\SumberData;
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
				$kategori_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,2)->getValue();
				if($kategori_!==0){
					$kategori_=$kategori::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,3)->getValue(),])['id'];
					if($kategori_==null){
						$kategori->nama=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,3)->getValue();
						$kategori->keterangan='';
						$kategori->save();
						$kategori_=$kategori::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,3)->getValue(),])['id'];
					}
					else$kategori_=1;
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
						elseif($j==1){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$tahun_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
							}
						}
						elseif($j==2){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$bulan_=$bulan::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								if($bulan_==null){
									$bulan_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
									\Yii::$app->db->createCommand()->insert('bulan',[
									'nama'=>$bulan_,
									])->execute();
								}
							}
							else$bulan_=1;
						}
						elseif($j==3){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$satuan_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
							}
						}
						elseif($j==4){
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

						elseif($j==5){
							if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue()!==null){
								$itemKategori_=$itemKategori::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),])['id'];
								if($itemKategori_==null){
									$itemKategori_=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue();
									\Yii::$app->db->createCommand()->insert('item_kategori',[
									'nama'=>$itemKategori_,
									'id_kategori'=>$kategori_,
									])->execute();
									$itemKategori_=$itemKategori::findOne(['nama'=>$variabel_,])['id'];
								}
							}
							else$itemKategori_=1;
						}
						else{
							$idwilayah=$wilayah::findOne(['nama'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,5)->getValue(),])['id'];
							\Yii::$app->db->createCommand()->insert('fakta',[
							'tahun'=>$tahun_,
							'nilai'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j,$i)->getValue(),
							'id_bulan'=>$bulan_,
							'id_wilayah'=>$idwilayah,
							'id_variabel'=>$variabel_,
							'id_item_kategori'=>$itemKategori_,
							'id_sumber_data'=>$sumberData_,
							])->execute();
						}
					}
				}//end of baris
				unlink('uploads/'.$model->file->baseName.'.'.$model->file->extension);
				return\Yii::$app->response->redirect('?r=fakta',301)->send();
			}
		}

		return$this->render('import',['model'=>$model]);
	}

	publicfunctionactionLogin()
	{
		if(!\Yii::$app->user->isGuest){
			return$this->goHome();
		}

		$model=newLoginForm();
		if($model->load(Yii::$app->request->post())&&$model->login()){
			return$this->goBack();
		}else{
			return$this->render('login',[
			'model'=>$model,
			]);
		}
	}

	publicfunctionactionLogout()
	{
		Yii::$app->user->logout();

		return$this->goHome();
	}
	
	publicfunctionactionDownload()
	{
		
		$objReader=\PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel=$objReader->load('uploads/upload-database.xls');

		$id=$_POST['Wilayah']['nama'];

		if($id!==null){
			$list=\common\models\Wilayah::find()->andWhere(['id_parent'=>$id])->asArray()->all();
			$selected=null;
			if($id!=null&&count($list)>0){
				$selected='';
				$col=6;
				foreach($listas$i=>$wil){
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

			$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
	}

	publicfunctionactionChild(){
		\Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
		$out=[];
		if(isset($_POST['depdrop_parents'])){
			$id=end($_POST['depdrop_parents']);
			$list=\common\models\Wilayah::find()->andWhere(['tipe'=>$id])->asArray()->all();
			$selected=null;
			if($id!=null&&count($list)>0){
				$selected='';
				foreach($listas$i=>$account){
					$out[]=['id'=>$account['id'],'name'=>$account['nama']];
					if($i==0){
						$selected=$account['id'];
					}
				}
				// Shows how you can preselect a value
				return(['output'=>$out,'selected'=>$selected]);
				
			}
		}
		return(['output'=>'','selected'=>'']);
	}
	
	publicfunctionbeforeAction($action){
		$this->enableCsrfValidation=false;// <-- here
		returnparent::beforeAction($action);
	}
	

}