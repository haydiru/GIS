<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipe_wilayah".
 *
 * @property integer $id
 * @property string $nama
 */
class TipeWilayah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipe_wilayah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'integer'],
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
            'nama' => 'Tipe Wilayah',
        ];
    }
}
