<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%st_spd}}".
 *
 * @property int $id
 * @property string $nomor_st
 * @property string $tanggal_terbit
 * @property string $nip
 * @property string $nomor_spd
 * @property string $maksud
 * @property string $kota_asal
 * @property string $kota_tujuan
 * @property string $tanggal_pergi
 * @property string $tanggal_kembali
 * @property string $tingkat_perjalanan_dinas
 * @property int $id_kendaraan
 * @property string $kode_program
 * @property int $kode_kegiatan
 * @property int $kode_output
 * @property int $kode_komponen
 * @property string $st_path
 * @property int $id_instansi
 * @property string $nip_kepala
 * @property string $nip_ppk
 * @property string $nip_bendahara
 * @property int $id_akun
 *
 * @property Instansi $instansi
 * @property Akun $akun
 * @property Pegawai $nip0
 * @property Kendaraan $kendaraan
 * @property Program $kodeProgram
 * @property Kegiatan $kodeKegiatan
 * @property Output $kodeOutput
 * @property Komponen $kodeKomponen
 * @property Pegawai $nipKepala
 * @property Pegawai $nipPpk
 * @property Pegawai $nipBendahara
 * @property StSpdAnggota[] $stSpdAnggotas
 */
class StSpd extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%st_spd}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomor_st', 'tanggal_terbit', 'nip', 'nomor_spd', 'maksud', 'kota_asal', 'kota_tujuan', 'tanggal_pergi', 'tanggal_kembali', 'tingkat_perjalanan_dinas', 'id_kendaraan', 'kode_program', 'kode_kegiatan', 'kode_output', 'kode_komponen', 'id_instansi', 'nip_kepala', 'nip_ppk', 'nip_bendahara', 'id_akun'], 'required'],
            [['tanggal_terbit', 'tanggal_pergi', 'tanggal_kembali'], 'safe'],
            [['nip', 'id_kendaraan', 'kode_kegiatan', 'kode_output', 'kode_komponen', 'id_instansi', 'nip_kepala', 'nip_ppk', 'nip_bendahara', 'id_akun'], 'integer'],
            [['maksud'], 'string'],
            [['nomor_st', 'nomor_spd', 'st_path'], 'string', 'max' => 120],
            [['kota_asal', 'kota_tujuan'], 'string', 'max' => 30],
            [['tingkat_perjalanan_dinas'], 'string', 'max' => 1],
            [['kode_program'], 'string', 'max' => 9],
            [['nomor_st'], 'unique'],
            [['id_instansi'], 'exist', 'skipOnError' => true, 'targetClass' => Instansi::className(), 'targetAttribute' => ['id_instansi' => 'id']],
            [['id_akun'], 'exist', 'skipOnError' => true, 'targetClass' => Akun::className(), 'targetAttribute' => ['id_akun' => 'id']],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip' => 'nip']],
            [['id_kendaraan'], 'exist', 'skipOnError' => true, 'targetClass' => Kendaraan::className(), 'targetAttribute' => ['id_kendaraan' => 'id']],
            [['kode_program'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['kode_program' => 'kode']],
            [['kode_kegiatan'], 'exist', 'skipOnError' => true, 'targetClass' => Kegiatan::className(), 'targetAttribute' => ['kode_kegiatan' => 'kode']],
            [['kode_output'], 'exist', 'skipOnError' => true, 'targetClass' => Output::className(), 'targetAttribute' => ['kode_output' => 'kode']],
            [['kode_komponen'], 'exist', 'skipOnError' => true, 'targetClass' => Komponen::className(), 'targetAttribute' => ['kode_komponen' => 'id']],
            [['nip_kepala'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_kepala' => 'nip']],
            [['nip_ppk'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_ppk' => 'nip']],
            [['nip_bendahara'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip_bendahara' => 'nip']],
        ];
    }

    /**
     * @inheritdoc
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
            'kode_output' => 'Kode Output',
            'kode_komponen' => 'Kode Komponen',
            'st_path' => 'St Path',
            'id_instansi' => 'Id Instansi',
            'nip_kepala' => 'Nip Kepala',
            'nip_ppk' => 'Nip Ppk',
            'nip_bendahara' => 'Nip Bendahara',
            'id_akun' => 'Id Akun',
        ];
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
    public function getAkun()
    {
        return $this->hasOne(Akun::className(), ['id' => 'id_akun']);
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
        return $this->hasOne(Program::className(), ['kode' => 'kode_program']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKegiatan()
    {
        return $this->hasOne(Kegiatan::className(), ['kode' => 'kode_kegiatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeOutput()
    {
        return $this->hasOne(Output::className(), ['kode' => 'kode_output']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKomponen()
    {
        return $this->hasOne(Komponen::className(), ['id' => 'kode_komponen']);
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
    public function getNipPpk()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip_ppk']);
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
    public function getStSpdAnggotas()
    {
        return $this->hasMany(StSpdAnggota::className(), ['id_st_spd' => 'id']);
    }
}
