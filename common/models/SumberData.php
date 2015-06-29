<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sumber_data".
 *
 * @property integer $id
 * @property integer $tipe
 * @property string $nama_cs
 * @property string $tanggal_cs
 * @property string $institusi_cs
 * @property string $deskripsi_cs
 * @property string $nama_buku
 * @property string $tanggal_buku
 * @property string $penerbit_buku
 * @property integer $status
 *
 * @property Fakta[] $faktas
 */
class SumberData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sumber_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipe', 'status'], 'integer'],
            [['tanggal_cs', 'tanggal_buku'], 'safe'],
            [['institusi_cs', 'deskripsi_cs', 'penerbit_buku'], 'string'],
            [['nama_cs', 'nama_buku'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipe' => 'Tipe',
            'nama_cs' => 'Nama Cs',
            'tanggal_cs' => 'Tanggal Cs',
            'institusi_cs' => 'Institusi Cs',
            'deskripsi_cs' => 'Deskripsi Cs',
            'nama_buku' => 'Nama Buku',
            'tanggal_buku' => 'Tanggal Buku',
            'penerbit_buku' => 'Penerbit Buku',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaktas()
    {
        return $this->hasMany(Fakta::className(), ['id_sumber_data' => 'id']);
    }
}
