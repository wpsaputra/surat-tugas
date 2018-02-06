<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kwitansi;

/**
 * KwitansiSearch represents the model behind the search form of `app\models\Kwitansi`.
 */
class KwitansiSearch extends Kwitansi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_st', 'nip'], 'integer'],
            [['uang_harian', 'uang_harian_total', 'biaya_transportasi', 'biaya_penginapan', 'jumlah_pdb', 'hari_inap_riil', 'biaya_inap_riil', 'biaya_inap_riil_total', 'transport_riil', 'taksi_riil', 'representasi_riil', 'representasi_riil_total', 'jumlah_riil'], 'number'],
            [['tanggal_bayar', 'kwitansi_path'], 'safe'],
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
        $query = Kwitansi::find();

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
            'id' => $this->id,
            'uang_harian' => $this->uang_harian,
            'uang_harian_total' => $this->uang_harian_total,
            'biaya_transportasi' => $this->biaya_transportasi,
            'biaya_penginapan' => $this->biaya_penginapan,
            'jumlah_pdb' => $this->jumlah_pdb,
            'hari_inap_riil' => $this->hari_inap_riil,
            'biaya_inap_riil' => $this->biaya_inap_riil,
            'biaya_inap_riil_total' => $this->biaya_inap_riil_total,
            'transport_riil' => $this->transport_riil,
            'taksi_riil' => $this->taksi_riil,
            'representasi_riil' => $this->representasi_riil,
            'representasi_riil_total' => $this->representasi_riil_total,
            'jumlah_riil' => $this->jumlah_riil,
            'tanggal_bayar' => $this->tanggal_bayar,
            'id_st' => $this->id_st,
            'nip' => $this->nip,
        ]);

        $query->andFilterWhere(['like', 'kwitansi_path', $this->kwitansi_path]);

        return $dataProvider;
    }
}
