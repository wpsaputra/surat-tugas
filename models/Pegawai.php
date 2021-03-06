<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%pegawai}}".
 *
 * @property string $nip
 * @property string $nama
 * @property string $pangkat
 * @property string $jabatan
 * @property int $flag_pensiun
 * @property int $id_instansi
 *
 * @property FlagBendahara[] $flagBendaharas
 * @property FlagKepala[] $flagKepalas
 * @property FlagPpk[] $flagPpks
 * @property Instansi $instansi
 * @property SuratTugas[] $suratTugas
 * @property SuratTugas[] $suratTugas0
 * @property SuratTugas[] $suratTugas1
 * @property SuratTugas[] $suratTugas2
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const SCENARIO_ADMIN = 'admin';

    public static function tableName()
    {
        return '{{%pegawai}}';
    }

    public function behaviors() {
        
        return [
            "auto_fill_instansi_with_user"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'id_instansi',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'id_instansi',
                ],
                'value' => function ($event) {
                    return Yii::$app->user->identity->id_instansi;
                },
            ],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'nama', 'pangkat', 'jabatan', 'flag_pensiun'], 'required'],
            [['nip', 'flag_pensiun', 'id_instansi'], 'integer'],
            [['nama'], 'string', 'max' => 37],
            [['pangkat'], 'string', 'max' => 28],
            [['jabatan'], 'string', 'max' => 65],
            [['nip'], 'unique'],
            [['id_instansi'], 'exist', 'skipOnError' => true, 'targetClass' => Instansi::className(), 'targetAttribute' => ['id_instansi' => 'id']],
            [['id_instansi'], 'required', 'on'=>self::SCENARIO_ADMIN],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'Nip',
            'nama' => 'Nama',
            'pangkat' => 'Pangkat',
            'jabatan' => 'Jabatan',
            'flag_pensiun' => 'Flag Pensiun',
            'id_instansi' => 'Id Instansi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlagBendaharas()
    {
        return $this->hasMany(FlagBendahara::className(), ['nip' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlagKepalas()
    {
        return $this->hasMany(FlagKepala::className(), ['nip' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlagPpks()
    {
        return $this->hasMany(FlagPpk::className(), ['nip' => 'nip']);
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
    public function getSuratTugas()
    {
        return $this->hasMany(SuratTugas::className(), ['nip' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas0()
    {
        return $this->hasMany(SuratTugas::className(), ['nip_bendahara' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas1()
    {
        return $this->hasMany(SuratTugas::className(), ['nip_kepala' => 'nip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugas2()
    {
        return $this->hasMany(SuratTugas::className(), ['nip_ppk' => 'nip']);
    }
}
