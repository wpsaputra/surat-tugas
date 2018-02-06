<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%kwitansi}}".
 *
 * @property int $id
 * @property string $uang_harian
 * @property string $uang_harian_total
 * @property string $biaya_transportasi
 * @property string $biaya_penginapan
 * @property string $jumlah_pdb
 * @property string $hari_inap_riil
 * @property string $biaya_inap_riil
 * @property string $biaya_inap_riil_total
 * @property string $transport_riil
 * @property string $taksi_riil
 * @property string $representasi_riil
 * @property string $representasi_riil_total
 * @property string $jumlah_riil
 * @property string $tanggal_bayar
 * @property string $kwitansi_path
 * @property int $id_st
 * @property string $nip
 *
 * @property StSpd $st
 * @property Pegawai $nip0
 */
class Kwitansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kwitansi}}';
    }

    public function behaviors() {
        
        return [
            "tanggalBayarBeforeSave" => [
                "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_bayar",
                        ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_bayar",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_terbit, "Y-MM-dd"); }
            ],
            "tanggalBayarAfterFind" => [
                   "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_AFTER_FIND => "tanggal_bayar",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_terbit, "MMM dd, Y"); }
                    
            ],


        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uang_harian', 'biaya_transportasi', 'biaya_penginapan', 'hari_inap_riil', 'biaya_inap_riil', 'transport_riil', 'taksi_riil', 'representasi_riil', 'tanggal_bayar', 'id_st', 'nip'], 'required'],
            [['uang_harian', 'uang_harian_total', 'biaya_transportasi', 'biaya_penginapan', 'jumlah_pdb', 'hari_inap_riil', 'biaya_inap_riil', 'biaya_inap_riil_total', 'transport_riil', 'taksi_riil', 'representasi_riil', 'representasi_riil_total', 'jumlah_riil'], 'number'],
            [['tanggal_bayar'], 'safe'],
            [['id_st', 'nip'], 'integer'],
            [['kwitansi_path'], 'string', 'max' => 120],
            [['id_st', 'nip'], 'unique', 'targetAttribute' => ['id_st', 'nip']],
            [['id_st'], 'exist', 'skipOnError' => true, 'targetClass' => StSpd::className(), 'targetAttribute' => ['id_st' => 'id']],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip' => 'nip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uang_harian' => 'Uang Harian',
            'uang_harian_total' => 'Uang Harian Total',
            'biaya_transportasi' => 'Biaya Transportasi',
            'biaya_penginapan' => 'Biaya Penginapan',
            'jumlah_pdb' => 'Jumlah Pdb',
            'hari_inap_riil' => 'Hari Inap Riil',
            'biaya_inap_riil' => 'Biaya Inap Riil',
            'biaya_inap_riil_total' => 'Biaya Inap Riil Total',
            'transport_riil' => 'Transport Riil',
            'taksi_riil' => 'Taksi Riil',
            'representasi_riil' => 'Representasi Riil',
            'representasi_riil_total' => 'Representasi Riil Total',
            'jumlah_riil' => 'Jumlah Riil',
            'tanggal_bayar' => 'Tanggal Bayar',
            'kwitansi_path' => 'Kwitansi Path',
            'id_st' => 'Id St',
            'nip' => 'Nip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSt()
    {
        return $this->hasOne(StSpd::className(), ['id' => 'id_st']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNip0()
    {
        return $this->hasOne(Pegawai::className(), ['nip' => 'nip']);
    }
}
