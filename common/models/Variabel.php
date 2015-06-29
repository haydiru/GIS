<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel".
 *
 * @property integer $id
 * @property integer $id_topik
 * @property string $nama
 * @property string $keterangan
 * @property string $satuan
 *
 * @property Fakta[] $faktas
 * @property KamusIndikator[] $kamusIndikators
 * @property Topik $idTopik
 */
class Variabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'variabel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_topik', 'nama', 'keterangan', 'satuan'], 'required'],
            [['id_topik'], 'integer'],
            [['keterangan'], 'string'],
            [['nama', 'satuan'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_topik' => 'Id Topik',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'satuan' => 'Satuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaktas()
    {
        return $this->hasMany(Fakta::className(), ['id_variabel' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKamusIndikators()
    {
        return $this->hasMany(KamusIndikator::className(), ['id_variabel' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTopik()
    {
        return $this->hasMany(Topik::className(), ['id' => 'id_topik']);
    }
}
