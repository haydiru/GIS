<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fakta;

/**
 * FaktaSearch represents the model behind the search form about `common\models\Fakta`.
 */
class FaktaSearch extends Fakta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tahun', 'id_bulan', 'id_variabel', 'id_item_kategori', 'id_sumber_data'], 'integer'],
            [['id_wilayah'], 'safe'],
            [['nilai'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Fakta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tahun' => $this->tahun,
            'id_bulan' => $this->id_bulan,
            'id_variabel' => $this->id_variabel,
            'id_item_kategori' => $this->id_item_kategori,
            'id_sumber_data' => $this->id_sumber_data,
            'nilai' => $this->nilai,
        ]);
		
        $query->andFilterWhere(['like', 'id_wilayah', $this->id_wilayah]);

        return $dataProvider;
    }
}
