<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wilayah".
 *
 * @property string $id
 * @property string $nama
 * @property string $id_parent
 * @property integer $tipe
 *
 * @property Fakta[] $faktas
 * @property GeoserverUrl[] $geoserverUrls
 */
class Wilayah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wilayah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'id_parent', 'tipe'], 'required'],
            [['tipe'], 'integer'],
            [['id', 'id_parent'], 'string', 'max' => 11],
            [['nama'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'id_parent' => 'Id Parent',
            'tipe' => 'Tipe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaktas()
    {
        return $this->hasMany(Fakta::className(), ['id_wilayah' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoserverUrls()
    {
        return $this->hasMany(GeoserverUrl::className(), ['id_wilayah' => 'id']);
    }
}
