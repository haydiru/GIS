<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "topik".
 *
 * @property integer $kode
 * @property string $nama
 * @property string $keterangan
 * @property integer $kode_parent
 */
class Topik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topik';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'keterangan', 'kode_parent'], 'required'],
            [['keterangan'], 'string'],
            [['kode_parent'], 'integer'],
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
            'kode_parent' => 'Kode Parent',
        ];
    }
}
