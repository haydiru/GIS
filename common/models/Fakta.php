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
 * @property integer $id_variabel
 * @property integer $id_item_kategori
 * @property integer $id_sumber_data
 * @property double $nilai
 *
 * @property Bulan $idBulan
 * @property ItemKategori $idItemKategori
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
            [['tahun', 'id_bulan', 'id_wilayah', 'id_variabel', 'id_item_kategori', 'id_sumber_data', 'nilai'], 'required'],
            [['tahun', 'id_bulan', 'id_variabel', 'id_item_kategori', 'id_sumber_data'], 'integer'],
            [['nilai'], 'number'],
            [['id_wilayah'], 'string', 'max' => 11]
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
            'id_variabel' => 'Id Variabel',
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
	public function getParentName(){
		$model=$this->idWilayah;
		return $model?$model->nama:'';
	}
}
