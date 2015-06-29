<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "topik_variabel".
 *
 * @property integer $kode
 * @property integer $kode_topik
 * @property integer $kode_variabel
 * @property string $satuan
 */
class TopikVariabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topik_variabel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_topik', 'kode_variabel', 'satuan'], 'required'],
            [['kode_topik', 'kode_variabel'], 'integer'],
            [['satuan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'kode_topik' => 'Kode Topik',
            'kode_variabel' => 'Kode Variabel',
            'satuan' => 'Satuan',
        ];
    }
}
