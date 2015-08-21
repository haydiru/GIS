<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GeoserverUrl;

/**
 * GeoserverSearch represents the model behind the search form about `common\models\GeoserverUrl`.
 */
class GeoserverSearch extends GeoserverUrl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zoom', 'tipe'], 'integer'],
            [['id_wilayah', 'url'], 'safe'],
            [['center_x', 'center_y'], 'number'],
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
        $query = GeoserverUrl::find();

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
            'zoom' => $this->zoom,
            'center_x' => $this->center_x,
            'center_y' => $this->center_y,
            'tipe' => $this->tipe,
        ]);

        $query->andFilterWhere(['like', 'id_wilayah', $this->id_wilayah])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
