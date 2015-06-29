<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "variabel".
 *
 * @property integer $kode
 * @property string $nama
 * @property string $keterangan
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
            [['nama', 'keterangan'], 'required'],
            [['keterangan'], 'string'],
            [['nama'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
        ];
    }
}
