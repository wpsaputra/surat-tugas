<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use PhpOffice\PhpWord\TemplateProcessor;
use NumberToWords\NumberToWords;

/**
 * This is the model class for table "{{%kwitansi}}".
 *
 * @property int $id
 * @property int $jumlah_hari
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
    const SCENARIO_LUAR_KOTA = 'luar_kota';
    const BULAN = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];

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
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_bayar, "Y-MM-dd"); }
            ],
            "tanggalBayarAfterFind" => [
                   "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_AFTER_FIND => "tanggal_bayar",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_bayar, "MMM dd, Y"); }
                    
            ],

            "auto_fill_instansi_jumlah_hari"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'jumlah_hari',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'jumlah_hari',
                ],
                'value' => function ($event) {
                    $stspd = StSpd::find()->where(['id'=>$this->id_st])->asArray()->one();
                    $date1 = new \DateTime($stspd['tanggal_pergi']);
		            $date2 = new \DateTime($stspd['tanggal_kembali']);
                    $diff = $date2->diff($date1)->format("%a")+1;
                    return $diff;
                },
            ],

            "auto_fill_uang_harian_total"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'uang_harian_total',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'uang_harian_total',
                ],
                'value' => function ($event) {
                    $uang_harian_total = $this->uang_harian * $this->jumlah_hari;
                    return $uang_harian_total;
                },
            ],

            "auto_fill_biaya_inap_riil_total"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'biaya_inap_riil_total',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'biaya_inap_riil_total',
                ],
                'value' => function ($event) {
                    $biaya_inap_riil_total = $this->biaya_inap_riil * $this->hari_inap_riil * 0.3;
                    return $biaya_inap_riil_total;
                },
            ],

            "auto_fill_representasi_riil_total"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'representasi_riil_total',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'representasi_riil_total',
                ],
                'value' => function ($event) {
                    $representasi_riil_total = $this->representasi_riil * $this->jumlah_hari;
                    return $representasi_riil_total;
                },
            ],

            "auto_fill_jumlah_riil"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'jumlah_riil',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'jumlah_riil',
                ],
                'value' => function ($event) {
                    $jumlah_riil = $this->biaya_inap_riil_total + $this->transport_riil + $this->taksi_riil + $this->representasi_riil_total;
                    return $jumlah_riil;
                },
            ],

            "auto_fill_jumlah_pdb"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'jumlah_pdb',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'jumlah_pdb',
                ],
                'value' => function ($event) {
                    $jumlah_pdb = $this->uang_harian_total + $this->biaya_transportasi + $this->biaya_penginapan + $this->jumlah_riil;
                    return $jumlah_pdb;
                },
            ],

            "auto_fill_kwitansi_path"=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'kwitansi_path',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'kwitansi_path',
                ],
                'value' => function ($event) {
                    $path = 'KWITANSI-'.$this->id_st.'-'.$this->nip.'.docx';
                    return $path;
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
            [['jumlah_hari', 'id_st', 'nip', 'hari_inap_riil'], 'integer'],
            [['uang_harian', 'tanggal_bayar', 'id_st', 'nip'], 'required'],
            [['uang_harian', 'biaya_transportasi', 'biaya_penginapan', 'biaya_inap_riil', 'transport_riil', 'taksi_riil', 'representasi_riil', 'tanggal_bayar', 'id_st', 'nip', 'hari_inap_riil'], 'required', 'on'=>self::SCENARIO_LUAR_KOTA],
            [['uang_harian', 'uang_harian_total', 'biaya_transportasi', 'biaya_penginapan', 'jumlah_pdb', 'biaya_inap_riil', 'biaya_inap_riil_total', 'transport_riil', 'taksi_riil', 'representasi_riil', 'representasi_riil_total', 'jumlah_riil'], 'number'],
            [['tanggal_bayar'], 'safe'],
            [['kwitansi_path'], 'string', 'max' => 120],
            [['id_st', 'nip'], 'unique', 'targetAttribute' => ['id_st', 'nip']],
            [['id_st'], 'exist', 'skipOnError' => true, 'targetClass' => StSpd::className(), 'targetAttribute' => ['id_st' => 'id']],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['nip' => 'nip']],
            // custom
            [['hari_inap_riil'], 'authenticate_hari_inap_riil'],
            [['tanggal_bayar'], 'authenticate_tanggal_bayar'],
        ];
    }

    // custom rule
    public function authenticate_hari_inap_riil($attribute, $params, $validator)
	{
        $stspd = StSpd::find()->where(['id'=>$this->id_st])->asArray()->one();
        $date1 = new \DateTime($stspd['tanggal_pergi']);
		$date2 = new \DateTime($stspd['tanggal_kembali']);
        $diff = $date2->diff($date1)->format("%a")+1;

        if($this->hari_inap_riil > $diff){
            $this->addError('hari_inap_riil', 'Hari inap riil harus lebih kecil sama dengan hari perjalanan dinas ('.$diff.' hari)');
        }
    }

    public function authenticate_tanggal_bayar($attribute, $params, $validator)
	{
        $stspd = StSpd::find()->where(['id'=>$this->id_st])->asArray()->one();
        $tanggal_kembali = new \DateTime($stspd['tanggal_kembali']);
        $tanggal_bayar = \DateTime::createFromFormat('Y-m-d', Yii::$app->formatter->asDate($this->tanggal_bayar, "Y-MM-dd"));

        if($tanggal_kembali > $tanggal_bayar){
            $tanggal = Yii::$app->formatter->asDate($stspd['tanggal_kembali'], "dd MMMM Y");
            $this->addError('tanggal_bayar', 'Tanggal bayar harus lebih besar atau sama dengan tanggal kembali ('.$tanggal.' hari)');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jumlah_hari' => 'Jumlah Hari',
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

    public function createDocx()
    {
        // prepare array
        $arr_st_spd = StSpd::find()->where(['id'=>$this->id_st])->asArray()->one();
        if($arr_st_spd['id_akun']==524111){
            $templateProcessor = new TemplateProcessor('template/template_kwitansi_luar_kota.docx');
        }else{
            $templateProcessor = new TemplateProcessor('template/template_kwitansi_dalam_kota.docx');
        }
        
        // get attribute key & value for replace from this model 
        $arr_model_attr = array_keys($this->attributes);
        $arr_model_val = array_values($this->attributes);
        
        $i = 0;
        foreach ($arr_model_val as $key => $value) {
            // format number with . separator
            if(is_numeric($value) && $arr_model_attr[$i]!='nip'){
                $arr_model_val[$key] = number_format($value, 0, ".", ".");
            }

            if($arr_model_attr[$i]=='tanggal_bayar'){
                $arr_model_val[$key] = (int)Yii::$app->formatter->asDate($value, "dd").' '.
                    self::BULAN[Yii::$app->formatter->asDate($value, "M")].' '.Yii::$app->formatter->asDate($value, "Y"); 
            }

            $i++;
        }

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('id');
        $templateProcessor->setValue('terbilang_jumlah_pdb', ucwords($numberTransformer->toWords($this->jumlah_pdb)));
        $templateProcessor->setValue('terbilang_jumlah_riil', ucwords($numberTransformer->toWords($this->jumlah_riil)));

        // replace value from database to word without formatting first
        $templateProcessor->setValue($arr_model_attr, $arr_model_val);
        

        $arr_pegawai = Pegawai::find()->where(['nip'=>$this->nip])->asArray()->one();
        $arr_bendahara = Pegawai::find()->where(['nip'=>$arr_st_spd['nip_bendahara']])->asArray()->one();
        $arr_ppk = Pegawai::find()->where(['nip'=>$arr_st_spd['nip_ppk']])->asArray()->one();
        $arr_instansi = Instansi::find()->where(['id'=>$arr_st_spd['id_instansi']])->asArray()->one();

        // replace value which need formatting first
        // $templateProcessor->setValue('nama', $arr_pegawai['nama']);

        $templateProcessor->setValue('nama_ppk', $arr_ppk['nama']);
        $templateProcessor->setValue('nip_ppk', $arr_ppk['nip']);

        $templateProcessor->setValue('nama_bendahara', $arr_bendahara['nama']);
        $templateProcessor->setValue('nip_bendahara', $arr_bendahara['nip']);

        $templateProcessor->setValue('tanggal_terbit', (int)Yii::$app->formatter->asDate($arr_st_spd['tanggal_terbit'], "dd").' '.self::BULAN[Yii::$app->formatter->asDate($arr_st_spd['tanggal_terbit'], "M")].' '.Yii::$app->formatter->asDate($arr_st_spd['tanggal_terbit'], "Y"));
        $templateProcessor->setValue('kota_asal', $arr_st_spd['kota_asal']);
        // replace day
        $date1 = new \DateTime($arr_st_spd['tanggal_pergi']);
		$date2 = new \DateTime($arr_st_spd['tanggal_kembali']);
        $diff = $date2->diff($date1)->format("%a")+1;
        $templateProcessor->setValue('x_hari', $diff." Hari");


        $templateProcessor->setValue('id_instansi', $arr_instansi['instansi']);
        // with formatting
        $templateProcessor->setValue(array_keys($arr_pegawai), array_values($arr_pegawai));


        // get & set nomor spd from st_spd or st_spd_anggota
        $arr_st_spd_nmr = StSpd::find()->where(['id'=>$this->id_st, 'nip'=>$this->nip])->asArray()->one();
        if(is_null($arr_st_spd_nmr)){
            $arr_st_spd_nmr = StSpdAnggota::find()->where(['id_st_spd'=>$this->id_st, 'nip_anggota'=>$this->nip])->asArray()->one();
        }
        $templateProcessor->setValue('nomor_spd', $arr_st_spd_nmr['nomor_spd']);

        $templateProcessor->saveAs("download/".$this->kwitansi_path);
    }


}
