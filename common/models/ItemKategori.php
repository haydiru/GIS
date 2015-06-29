<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_kategori".
 *
 * @property integer $id
 * @property integer $id_kategori
 * @property string $nama
 *
 * @property Fakta[] $faktas
 * @property Kategori $idKategori
 */
class ItemKategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kategori', 'nama'], 'required'],
            [['id_kategori'], 'integer'],
            [['nama'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kategori' => 'Id Kategori',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaktas()
    {
        return $this->hasMany(Fakta::className(), ['id_item_kategori' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKategori()
    {
        return $this->hasMany(Kategori::className(), ['id' => 'id_kategori']);
    }
}
