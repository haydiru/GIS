<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fakta".
 *
 * @property integer $tahun
 * @property integer $kode_bulan
 * @property string $kode_wilayah
 * @property integer $kode_topik_variabel
 * @property integer $kode_item_kategori
 * @property integer $kode_sumber_data
 * @property double $nilai
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
            [['tahun', 'kode_bulan', 'kode_wilayah', 'kode_topik_variabel', 'kode_item_kategori', 'kode_sumber_data', 'nilai'], 'required'],
            [['tahun', 'kode_bulan', 'kode_topik_variabel', 'kode_item_kategori', 'kode_sumber_data'], 'integer'],
            [['nilai'], 'number'],
            [['kode_wilayah'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tahun' => 'Tahun',
            'kode_bulan' => 'Kode Bulan',
            'kode_wilayah' => 'Kode Wilayah',
            'kode_topik_variabel' => 'Kode Topik Variabel',
            'kode_item_kategori' => 'Kode Item Kategori',
            'kode_sumber_data' => 'Kode Sumber Data',
            'nilai' => 'Nilai',
        ];
    }
}
