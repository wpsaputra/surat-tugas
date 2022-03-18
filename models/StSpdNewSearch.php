<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StSpdNew;

/**
 * StSpdNewSearch represents the model behind the search form of `app\models\StSpdNew`.
 */
class StSpdNewSearch extends StSpdNew
{
    /**
     * {@inheritdoc}
     */
    public $nama_pegawai;
    
    public function rules()
    {
        return [
            [['id', 'nip', 'id_kendaraan', 'kode_program', 'kode_kegiatan', 'kode_kro', 'kode_ro', 'kode_komponen', 'kode_subkomponen', 'id_akun', 'id_instansi', 'nip_kepala', 'nip_ppk', 'nip_ppk_dukman', 'nip_bendahara', 'flag_with_spd'], 'integer'],
            [['nomor_st', 'tanggal_terbit', 'nomor_spd', 'maksud', 'kota_asal', 'kota_tujuan', 'tanggal_pergi', 'tanggal_kembali', 'tingkat_perjalanan_dinas', 'st_path'], 'safe'],
            // custom
            [['nama_pegawai'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = StSpdNew::find()->joinWith('nip0');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // custom
        $dataProvider->sort->attributes['nama_pegawai'] = [
            'asc' => ['su_pegawai.nama' => SORT_ASC],
            'desc' => ['su_pegawai.nama' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_terbit' => $this->tanggal_terbit,
            // 'nip' => $this->nip,
            'tanggal_pergi' => $this->tanggal_pergi,
            'tanggal_kembali' => $this->tanggal_kembali,
            'id_kendaraan' => $this->id_kendaraan,
            'kode_program' => $this->kode_program,
            'kode_kegiatan' => $this->kode_kegiatan,
            'kode_kro' => $this->kode_kro,
            'kode_ro' => $this->kode_ro,
            'kode_komponen' => $this->kode_komponen,
            'kode_subkomponen' => $this->kode_subkomponen,
            'id_akun' => $this->id_akun,
            'id_instansi' => $this->id_instansi,
            'nip_kepala' => $this->nip_kepala,
            'nip_ppk' => $this->nip_ppk,
            'nip_ppk_dukman' => $this->nip_ppk_dukman,
            'nip_bendahara' => $this->nip_bendahara,
            'flag_with_spd' => $this->flag_with_spd,
        ]);

        $query->andFilterWhere(['like', 'nomor_st', $this->nomor_st])
            ->andFilterWhere(['like', 'nomor_spd', $this->nomor_spd])
            ->andFilterWhere(['like', 'maksud', $this->maksud])
            ->andFilterWhere(['like', 'kota_asal', $this->kota_asal])
            ->andFilterWhere(['like', 'kota_tujuan', $this->kota_tujuan])
            ->andFilterWhere(['like', 'tingkat_perjalanan_dinas', $this->tingkat_perjalanan_dinas])
            ->andFilterWhere(['like', 'st_path', $this->st_path]);

        return $dataProvider;
    }
}
