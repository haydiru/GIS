<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fakta".
 *
 * @property integer $id
 * @property integer $tahun
 * @property integer $id_bulan
 * @property string $id_wilayah
 * @property string $kode_unik
 * @property integer $id_variabel
 * @property integer $id_kategori
 * @property integer $id_item_kategori
 * @property integer $id_sumber_data
 * @property double $nilai
 *
 * @property Bulan $idBulan
 * @property ItemKategori $idItemKategori
 * @property Kategori $idKategori
 * @property SumberData $idSumberData
 * @property Variabel $idVariabel
 * @property Wilayah $idWilayah
 */
class Fakta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fakta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'id_bulan', 'id_wilayah', 'kode_unik', 'id_variabel', 'id_kategori', 'id_item_kategori', 'id_sumber_data', 'nilai'], 'required'],
            [['tahun', 'id_bulan', 'id_variabel', 'id_kategori', 'id_item_kategori', 'id_sumber_data'], 'integer'],
            [['nilai'], 'number'],
            [['id_wilayah'], 'string', 'max' => 11],
            [['kode_unik'], 'string', 'max' => 50],
            [['kode_unik'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'id_bulan' => 'Id Bulan',
            'id_wilayah' => 'Id Wilayah',
            'kode_unik' => 'Kode Unik',
            'id_variabel' => 'Id Variabel',
            'id_kategori' => 'Id Kategori',
            'id_item_kategori' => 'Id Item Kategori',
            'id_sumber_data' => 'Id Sumber Data',
            'nilai' => 'Nilai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBulan()
    {
        return $this->hasOne(Bulan::className(), ['id' => 'id_bulan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdItemKategori()
    {
        return $this->hasOne(ItemKategori::className(), ['id' => 'id_item_kategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKategori()
    {
        return $this->hasOne(Kategori::className(), ['id' => 'id_kategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSumberData()
    {
        return $this->hasOne(SumberData::className(), ['id' => 'id_sumber_data']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVariabel()
    {
        return $this->hasOne(Variabel::className(), ['id' => 'id_variabel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWilayah()
    {
        return $this->hasOne(Wilayah::className(), ['id' => 'id_wilayah']);
    }
	
	public function getParentNameWilayah(){
		$model=$this->idWilayah;
		return $model?$model->nama:'';
	}
		public function getParentNameBulan(){
		$model=$this->idBulan;
		return $model?$model->nama:'';
	}
		public function getParentNameVariabel(){
		$model=$this->idVariabel;
		return $model?$model->nama:'';
	}
			public function getParentNameKategori(){
		$model=$this->idKategori;
		return $model?$model->nama:'';
	}			
	public function getParentNameSumberData(){
		$model=$this->idSumberData;
		return $model?$model->nama_cs:'';
	}
}
