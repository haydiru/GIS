<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $id_variabel
 * @property string $keterangan
 *
 * @property Fakta[] $faktas
 * @property Variabel $idVariabel
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['id_variabel'], 'integer'],
            [['keterangan'], 'string'],
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
            'id_variabel' => 'Id Variabel',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaktas()
    {
        return $this->hasMany(Fakta::className(), ['id_kategori' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVariabel()
    {
        return $this->hasOne(Variabel::className(), ['id' => 'id_variabel']);
    }
}
