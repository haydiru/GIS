<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "geoserver_url".
 *
 * @property integer $id
 * @property string $id_wilayah
 * @property string $url
 * @property integer $zoom
 * @property double $center_x
 * @property double $center_y
 * @property integer $tipe
 *
 * @property Wilayah $idWilayah
 */
class GeoserverUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geoserver_url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_wilayah', 'url', 'zoom', 'center_x', 'center_y', 'tipe'], 'required'],
            [['url'], 'string'],
            [['zoom', 'tipe'], 'integer'],
            [['center_x', 'center_y'], 'number'],
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
            'id_wilayah' => 'Id Wilayah',
            'url' => 'Url',
            'zoom' => 'Zoom',
            'center_x' => 'Center X',
            'center_y' => 'Center Y',
            'tipe' => 'Tipe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWilayah()
    {
        return $this->hasOne(Wilayah::className(), ['id' => 'id_wilayah']);
    }
}
