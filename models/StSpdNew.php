<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "su_st_spd_new".
 *
 * @property int $id
 * @property string $nomor_st
 * @property string $tanggal_terbit
 * @property int $nip
 * @property string $nomor_spd
 * @property string $maksud
 * @property string $kota_asal
 * @property string $kota_tujuan
 * @property string $tanggal_pergi
 * @property string $tanggal_kembali
 * @property string $tingkat_perjalanan_dinas
 * @property int $id_kendaraan
 * @property int $kode_program
 * @property int $kode_kegiatan
 * @property int $kode_kro
 * @property int $kode_ro
 * @property int $kode_komponen
 * @property int $kode_subkomponen
 * @property int $id_akun
 * @property string $st_path
 * @property int $id_instansi
 * @property int $nip_kepala
 * @property int $nip_ppk
 * @property int $nip_ppk_dukman
 * @property int $nip_bendahara
 * @property int $flag_with_spd
 *
 * @property StSpdAnggotaNew[] $stSpdAnggotaNews
 * @property Instansi $instansi
 * @property TNewSubKomponen $kodeSubkomponen
 * @property TNewAkun $akun
 * @property Pegawai $nipKepala
 * @property Pegawai $nipBendahara
 * @property Pegawai $nipPpk
 * @property Pegawai $nipPpkDukman
 * @property TNewAkun $akun0
 * @property Pegawai $nip0
 * @property Kendaraan $kendaraan
 * @property TNewProgram $kodeProgram
 * @property TNewKegiatan $kodeKegiatan
 * @property TNewKro $kodeKro
 * @property TNewRo $kodeRo
 * @property TNewKomponen $kodeKomponen
 */
class StSpdNew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'su_st_spd_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_st', 'tanggal_terbit', 'nip', 'nomor_spd', 'maksud', 'kota_asal', 'kota_tujuan', 'tanggal_pergi', 'tanggal_kembali', 'tingkat_perjalanan_dinas', 'id_kendaraan', 'kode_program', 'kode_kegiatan', 'kode_kro', 'kode_ro', 'kode_komponen', 'kode_subkomponen', 'id_akun', 'id_instansi', 'nip_kepala', 'nip_ppk', 'nip_ppk_dukman', 'nip_bendahara', 'flag_with_spd'], 'required'],
            [['tanggal_terbit', 'tanggal_pergi', 'tanggal_kembali'], 'safe'],
            [['nip', 'id_kendaraan', 'kode_program', 'kode_kegiatan', 'kode_kro', 'kode_ro', 'kode_komponen', 'kode_subkomponen', 'id_akun', 'id_instansi', 'nip_kepala', 'nip_ppk', 'nip_ppk_dukman', 'nip_bendahara', 'flag_with_spd'], 'integer'],
            [['maksud'], 'string'],
            [['nomor_st', 'nomor_spd', 'st_path'], 'string', 'max' => 120],
            [['kota_asal', 'kota_tujuan'], 'string', 'max' => 30],
            [['tingkat_perjalanan_dinas'], 'string', 'max' => 1],
            [['nomor_st'], 'unique'],
            [['id_instansi'], 'exist', 'skipOnError' => true, 'targetClass' => Instansi::className(), 'targetAttribute' => ['id_instansi' => 'id']],
            [['kode_subkomponen'], 'exist', 'skipOnError' => true, 'targetClass' => TNewSubKomponen::className(), 'targetAttribute' => ['kode_subkomponen' => 'id']],
            [['id_akun'], 'exist', 'skipOnError' => true, 'targetClass' => TNewAkun::className(), 'targetAttribute' => ['id_akun' => 'id']],
            [['nip_kepala'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_kepala' => 'nip']],
            [['nip_bendahara'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_bendahara' => 'nip']],
            [['nip_ppk'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_ppk' => 'nip']],
            [['nip_ppk_dukman'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_ppk_dukman' => 'nip']],
            [['id_akun'], 'exist', 'skipOnError' => true, 'targetClass' => TNewAkun::className(), 'targetAttribute' => ['id_akun' => 'id']],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip' => 'nip']],
            [['id_kendaraan'], 'exist', 'skipOnError' => true, 'targetClass' => Kendaraan::className(), 'targetAttribute' => ['id_kendaraan' => 'id']],
            [['kode_program'], 'exist', 'skipOnError' => true, 'targetClass' => TNewProgram::className(), 'targetAttribute' => ['kode_program' => 'id']],
            [['kode_kegiatan'], 'exist', 'skipOnError' => true, 'targetClass' => TNewKegiatan::className(), 'targetAttribute' => ['kode_kegiatan' => 'id']],
            [['kode_kro'], 'exist', 'skipOnError' => true, 'targetClass' => TNewKro::className(), 'targetAttribute' => ['kode_kro' => 'id']],
            [['kode_ro'], 'exist', 'skipOnError' => true, 'targetClass' => TNewRo::className(), 'targetAttribute' => ['kode_ro' => 'id']],
            [['kode_komponen'], 'exist', 'skipOnError' => true, 'targetClass' => TNewKomponen::className(), 'targetAttribute' => ['kode_komponen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_st' => 'Nomor St',
            'tanggal_terbit' => 'Tanggal Terbit',
            'nip' => 'Nip',
            'nomor_spd' => 'Nomor Spd',
            'maksud' => 'Maksud',
            'kota_asal' => 'Kota Asal',
            'kota_tujuan' => 'Kota Tujuan',
            'tanggal_pergi' => 'Tanggal Pergi',
            'tanggal_kembali' => 'Tanggal Kembali',
            'tingkat_perjalanan_dinas' => 'Tingkat Perjalanan Dinas',
            'id_kendaraan' => 'Id Kendaraan',
            'kode_program' => 'Kode Program',
            'kode_kegiatan' => 'Kode Kegiatan',
            'kode_kro' => 'Kode Kro',
            'kode_ro' => 'Kode Ro',
            'kode_komponen' => 'Kode Komponen',
            'kode_subkomponen' => 'Kode Subkomponen',
            'id_akun' => 'Id Akun',
            'st_path' => 'St Path',
            'id_instansi' => 'Id Instansi',
            'nip_kepala' => 'Nip Kepala',
            'nip_ppk' => 'Nip Ppk',
            'nip_ppk_dukman' => 'Nip Ppk Dukman',
            'nip_bendahara' => 'Nip Bendahara',
            'flag_with_spd' => 'Flag With Spd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStSpdAnggotaNews()
    {
        return $this->hasMany(StSpdAnggotaNew::className(), ['id_st_spd' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstansi()
    {
        return $this->hasOne(Instansi::className(), ['id' => 'id_instansi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeSubkomponen()
    {
        return $this->hasOne(TNewSubKomponen::className(), ['id' => 'kode_subkomponen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkun()
    {
        return $this->hasOne(TNewAkun::className(), ['id' => 'id_akun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNipKepala()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip_kepala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNipBendahara()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip_bendahara']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNipPpk()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip_ppk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNipPpkDukman()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip_ppk_dukman']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkun0()
    {
        return $this->hasOne(TNewAkun::className(), ['id' => 'id_akun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNip0()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraan()
    {
        return $this->hasOne(Kendaraan::className(), ['id' => 'id_kendaraan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeProgram()
    {
        return $this->hasOne(TNewProgram::className(), ['id' => 'kode_program']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKegiatan()
    {
        return $this->hasOne(TNewKegiatan::className(), ['id' => 'kode_kegiatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKro()
    {
        return $this->hasOne(TNewKro::className(), ['id' => 'kode_kro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeRo()
    {
        return $this->hasOne(TNewRo::className(), ['id' => 'kode_ro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKomponen()
    {
        return $this->hasOne(TNewKomponen::className(), ['id' => 'kode_komponen']);
    }
}
