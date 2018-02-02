<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Output;

/**
 * OutputSearch represents the model behind the search form of `app\models\Output`.
 */
class OutputSearch extends Output
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'id_kegiatan'], 'integer'],
            [['uraian'], 'safe'],
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
        $query = Output::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'kode' => $this->kode,
            'id_kegiatan' => $this->id_kegiatan,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian]);

        return $dataProvider;
    }
}
