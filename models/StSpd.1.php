<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use PhpOffice\PhpWord\TemplateProcessor;

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
    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_INSERT = 'insert';
    const BULAN = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];

    public static function tableName()
    {
        return '{{%st_spd}}';
    }

    public function behaviors() {
        
        return [
            "tanggalTerbitBeforeSave" => [
                "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_terbit",
                        ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_terbit",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_terbit, "Y-MM-dd"); }
            ],
            "tanggalTerbitAfterFind" => [
                   "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_AFTER_FIND => "tanggal_terbit",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_terbit, "MMM dd, Y"); }
                    
            ],

            "tanggalPergiBeforeSave" => [
                "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_pergi",
                        ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_pergi",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_pergi, "Y-MM-dd"); }
            ],
            "tanggalPergiAfterFind" => [
                   "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_AFTER_FIND => "tanggal_pergi",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_pergi, "MMM dd, Y"); }
                    
            ],

            "tanggalKembaliBeforeSave" => [
                "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_kembali",
                        ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_kembali",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_kembali, "Y-MM-dd"); }
            ],
            "tanggalKembaliAfterFind" => [
                   "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_AFTER_FIND => "tanggal_kembali",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_kembali, "MMM dd, Y"); }
                    
            ],

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
            [['nomor_st', 'tanggal_terbit', 'nip', 'nomor_spd', 'maksud', 'kota_asal', 'kota_tujuan', 'tanggal_pergi', 'tanggal_kembali', 'tingkat_perjalanan_dinas', 'id_kendaraan', 'kode_program', 'kode_kegiatan', 'kode_output', 'kode_komponen', 'nip_kepala', 'nip_ppk', 'nip_bendahara', 'id_akun'], 'required'],
            [['tanggal_terbit', 'tanggal_pergi', 'tanggal_kembali', 'id_instansi'], 'safe'],
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
            // custom
            [['id_instansi'], 'required', 'on'=>self::SCENARIO_ADMIN],
            [['tanggal_pergi'], 'authenticate_t_pergi', 'on'=>self::SCENARIO_INSERT],
            [['tanggal_kembali'], 'authenticate_t_kembali', 'on'=>self::SCENARIO_INSERT],
        ];
    }

    // custom rule
    public function authenticate_t_pergi($attribute, $params, $validator)
	{
		$x_tanggal_terbit = \DateTime::createFromFormat('Y-m-d', Yii::$app->formatter->asDate($this->tanggal_terbit, "Y-MM-dd"));
		$x_tanggal_pergi = \DateTime::createFromFormat('Y-m-d', Yii::$app->formatter->asDate($this->tanggal_pergi, "Y-MM-dd"));
		if($x_tanggal_terbit>$x_tanggal_pergi){
			$this->addError('tanggal_pergi','Tanggal pergi harus lebih besar atau sama dengan tanggal terbit');
		}

		if(strlen($this->tanggal_terbit)>0&&strlen($this->tanggal_pergi)>0){
			$count = Yii::$app->db->createCommand("SELECT COUNT(id) FROM su_st_spd WHERE nip=:nip AND "."'".$x_tanggal_pergi->format("Y-m-d")."'"."BETWEEN tanggal_pergi AND tanggal_kembali")
				->bindValues(array("nip"=>$this->nip))->queryScalar();

			if($count>0){
				$this->addError('tanggal_pergi', 'Sudah Ada surat tugas dengan tanggal pergi yang sama');
			}
        }

    }
    
    public function authenticate_t_kembali($attribute, $params, $validator)
	{
		$x_tanggal_pergi = \DateTime::createFromFormat('Y-m-d', Yii::$app->formatter->asDate($this->tanggal_pergi, "Y-MM-dd"));
		$x_tanggal_kembali = \DateTime::createFromFormat('Y-m-d', Yii::$app->formatter->asDate($this->tanggal_kembali, "Y-MM-dd"));
		if($x_tanggal_pergi>$x_tanggal_kembali){
			$this->addError('tanggal_kembali','Tanggal kembali harus lebih besar sama dengan tanggal pergi');
		}

		if(strlen($this->tanggal_pergi)>0&&strlen($this->tanggal_kembali)>0){
			$count = Yii::$app->db->createCommand("SELECT COUNT(id) FROM su_st_spd WHERE nip=:nip AND "."'".$x_tanggal_kembali->format("Y-m-d")."'"."BETWEEN tanggal_pergi AND tanggal_kembali")
				->bindValues(array("nip"=>$this->nip))->queryScalar();

			if($count>0){
				$this->addError('tanggal_kembali', 'Sudah Ada surat tugas dengan tanggal kembali yang sama');
			}

		}

	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_st' => 'Nomor Surat Tugas',
            'tanggal_terbit' => 'Tanggal Terbit',
            'nip' => 'Nip',
            'nomor_spd' => 'Nomor Spd',
            'maksud' => 'Maksud',
            'kota_asal' => 'Kota Asal',
            'kota_tujuan' => 'Kota Tujuan',
            'tanggal_pergi' => 'Tanggal Pergi',
            'tanggal_kembali' => 'Tanggal Kembali',
            'tingkat_perjalanan_dinas' => 'Tingkat Perjalanan Dinas',
            'id_kendaraan' => 'Kendaraan',
            'kode_program' => 'Kode Program',
            'kode_kegiatan' => 'Kode Kegiatan',
            'kode_output' => 'Kode Output',
            'kode_komponen' => 'Kode Komponen',
            'st_path' => 'St Path',
            'id_instansi' => 'Nama Instansi',
            'nip_kepala' => 'Kepala',
            'nip_ppk' => 'PPK',
            'nip_bendahara' => 'Bendahara',
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
    
    // custom, generated pdf before save or insert
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $nomor_st = $this->nomor_st;
        $nomor_st = str_replace('/', '-', $nomor_st);
        // $this->st_path = "SPD-".$this->id.".docx";
        $this->st_path = "SPD-".$nomor_st.".docx";

        return true;
    }

    public function createDocx()
    {
        // set template based on anggota count
        $count = StSpdAnggota::find()->where(['id_st_spd'=>$this->id])->count();
        switch ($count) {
            case 0:
                $templateProcessor = new TemplateProcessor('template/template_st_spd_tanpa_anggota.docx');
                break;
            case 1:
                $templateProcessor = new TemplateProcessor('template/template_st_spd_dengan_anggota_1.docx');
                break;
            case 2:
                $templateProcessor = new TemplateProcessor('template/template_st_spd_dengan_anggota_2.docx');
                break;
            case 3:
                $templateProcessor = new TemplateProcessor('template/template_st_spd_dengan_anggota_3.docx');
                break;
            case 4:
                $templateProcessor = new TemplateProcessor('template/template_st_spd_dengan_anggota_4.docx');
                break;
            default:
               $templateProcessor = new TemplateProcessor('template/template_st_spd_tanpa_anggota.docx');
        }

        // get attribute key & value for replace from this model 
        $arr_model_attr = array_keys($this->attributes);
        $arr_model_val = array_values($this->attributes);

        // prepare array
        $arr_pegawai = Pegawai::find()->where(['nip'=>$this->nip])->asArray()->one();
        $arr_kepala = Pegawai::find()->where(['nip'=>$this->nip_kepala])->asArray()->one();
        $arr_bendahara = Pegawai::find()->where(['nip'=>$this->nip_bendahara])->asArray()->one();
        $arr_ppk = Pegawai::find()->where(['nip'=>$this->nip_ppk])->asArray()->one();
        $arr_instansi = Instansi::find()->where(['id'=>$this->instansi])->asArray()->one();
        $arr_kendaraan = Kendaraan::find()->where(['id'=>$this->id_kendaraan])->asArray()->one();

        // replace value which need formatting first
        $templateProcessor->setValue('nama_kepala', $arr_kepala['nama']);
        $templateProcessor->setValue('nama_ppk', $arr_ppk['nama']);
        $templateProcessor->setValue('id_instansi', $arr_instansi['instansi']);
        $templateProcessor->setValue('c_id_instansi', strtoupper($arr_instansi['instansi']));
        $templateProcessor->setValue('kode_output', str_pad($this->kode_output, 3, '0', STR_PAD_LEFT));
        $templateProcessor->setValue('kode_komponen', str_pad($this->kode_komponen, 3, '0', STR_PAD_LEFT));
        $templateProcessor->setValue('tanggal_terbit', (int)Yii::$app->formatter->asDate($this->tanggal_terbit, "dd").' '.self::BULAN[Yii::$app->formatter->asDate($this->tanggal_terbit, "M")].' '.Yii::$app->formatter->asDate($this->tanggal_terbit, "Y"));
        $templateProcessor->setValue('tanggal_pergi', (int)Yii::$app->formatter->asDate($this->tanggal_pergi, "dd").' '.self::BULAN[Yii::$app->formatter->asDate($this->tanggal_pergi, "M")].' '.Yii::$app->formatter->asDate($this->tanggal_terbit, "Y"));
        $templateProcessor->setValue('tanggal_kembali', (int)Yii::$app->formatter->asDate($this->tanggal_kembali, "dd").' '.self::BULAN[Yii::$app->formatter->asDate($this->tanggal_kembali, "M")].' '.Yii::$app->formatter->asDate($this->tanggal_terbit, "Y"));
        $templateProcessor->setValue('id_kendaraan', $arr_kendaraan['nama_kendaraan']);

        // replace value from database to word without formatting first
        $templateProcessor->setValue($arr_model_attr, $arr_model_val);
        $templateProcessor->setValue(array_keys($arr_pegawai), array_values($arr_pegawai));

        // replace day
        $date1 = new \DateTime($this->tanggal_pergi);
		$date2 = new \DateTime($this->tanggal_kembali);
        $diff = $date2->diff($date1)->format("%a")+1;
        $templateProcessor->setValue('x_hari', $diff." Hari");

        // for spd with anggota
        if($count > 0){
            $i = 1;
            $anggotas = StSpdAnggota::find()->where(['id_st_spd'=>$this->id])->asArray()->all();
            foreach ($anggotas as $key => $value) {
                $arr_anggota = Pegawai::find()->where(['nip'=>$value['nip_anggota']])->asArray()->one();
                
                $templateProcessor->setValue('nomor_spd_'.$i, $value['nomor_spd']);
                $templateProcessor->setValue('nip_anggota_'.$i, $value['nip_anggota']);
                
                $templateProcessor->setValue('nama_anggota_'.$i, $arr_anggota['nama']);
                $templateProcessor->setValue('pangkat_anggota_'.$i, $arr_anggota['pangkat']);
                $templateProcessor->setValue('jabatan_anggota_'.$i, $arr_anggota['jabatan']);

                $i++;
            }
        }
        $templateProcessor->saveAs("download/".$this->st_path);


    }
}
