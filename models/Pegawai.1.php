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
 * @property int $flag_kepala
 * @property int $flag_bendahara
 * @property int $flag_pensiun
 * @property int $id_instansi
 *
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
            "auto_fill_flag_kepala"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'flag_kepala',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'flag_kepala',
                ],
                'value' => function ($event) {
                    return 0;
                },
            ],
            "auto_fill_flag_bendahara"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'flag_bendahara',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'flag_bendahara',
                ],
                'value' => function ($event) {
                    return 0;
                },
            ],
            "auto_fill_flag_pensiun"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'flag_pensiun',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'flag_pensiun',
                ],
                'value' => function ($event) {
                    return 0;
                },
            ]

            
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'nama', 'pangkat', 'jabatan'], 'required'],
            [['nip', 'flag_kepala', 'flag_bendahara', 'flag_pensiun', 'id_instansi'], 'integer'],
            [['nama'], 'string', 'max' => 37],
            [['pangkat'], 'string', 'max' => 28],
            [['jabatan'], 'string', 'max' => 65],
            [['nip'], 'unique'],
            [['id_instansi'], 'exist', 'skipOnError' => true, 'targetClass' => Instansi::className(), 'targetAttribute' => ['id_instansi' => 'id']],
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
            'flag_kepala' => 'Flag Kepala',
            'flag_bendahara' => 'Flag Bendahara',
            'flag_pensiun' => 'Flag Pensiun',
            'id_instansi' => 'Id Instansi',
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
