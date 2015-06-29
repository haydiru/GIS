<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "topik".
 *
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property integer $id_parent
 *
 * @property Variabel[] $variabels
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
            [['nama', 'keterangan', 'id_parent'], 'required'],
            [['keterangan'], 'string'],
            [['id_parent'], 'integer'],
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
            'keterangan' => 'Keterangan',
            'id_parent' => 'Id Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariabels()
    {
        return $this->hasMany(Variabel::className(), ['id_topik' => 'id']);
    }
}
