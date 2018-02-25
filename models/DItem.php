<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%d_item}}".
 *
 * @property int $id
 * @property int $thang
 * @property string $kdjendok
 * @property string $kdsatker
 * @property string $kddept
 * @property string $kdunit
 * @property string $kdprogram
 * @property string $kdgiat
 * @property string $kdoutput
 * @property string $kdlokasi
 * @property string $kdkabkota
 * @property string $kddekon
 * @property string $kdsoutput
 * @property string $kdkmpnen
 * @property string $kdskmpnen
 * @property string $kdakun
 * @property string $kdkppn
 * @property string $kdbeban
 * @property string $kdjnsban
 * @property string $kdctarik
 * @property string $register
 * @property string $carahitung
 * @property string $header1
 * @property string $header2
 * @property string $kdheader
 * @property string $noitem
 * @property string $nmitem
 * @property string $vol1
 * @property string $sat1
 * @property string $vol2
 * @property string $sat2
 * @property string $vol3
 * @property string $sat3
 * @property string $vol4
 * @property string $sat4
 * @property string $volkeg
 * @property string $satkeg
 * @property string $hargasat
 * @property string $jumlah
 * @property string $jumlah2
 * @property string $paguphln
 * @property string $pagurmp
 * @property string $pagurkp
 * @property string $kdblokir
 * @property string $blokirphln
 * @property string $blokirrmp
 * @property string $blokirrkp
 * @property string $rphblokir
 * @property string $kdcopy
 * @property string $kdabt
 * @property string $kdsbu
 * @property string $volsbk
 * @property string $volrkakl
 * @property string $blnkontrak
 * @property string $nokontrak
 * @property string $tgkontrak
 * @property string $nilkontrak
 * @property string $januari
 * @property string $pebruari
 * @property string $maret
 * @property string $april
 * @property string $mei
 * @property string $juni
 * @property string $juli
 * @property string $agustus
 * @property string $september
 * @property string $oktober
 * @property string $nopember
 * @property string $desember
 * @property string $jmltunda
 * @property string $kdluncuran
 * @property string $jmlabt
 * @property string $norev
 * @property string $kdubah
 * @property string $kurs
 * @property string $indexkpjm
 * @property string $kdib
 */
class DItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%d_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'thang', 'hargasat', 'jumlah'], 'integer'],
            [['kdjendok', 'kdunit', 'kdprogram', 'kdlokasi', 'kdkabkota', 'kdskmpnen', 'header1', 'noitem', 'kdib'], 'string', 'max' => 2],
            [['kdsatker', 'kdakun', 'volkeg'], 'string', 'max' => 6],
            [['kddept', 'kdoutput', 'kdsoutput', 'kdkmpnen', 'kdkppn'], 'string', 'max' => 3],
            [['kdgiat'], 'string', 'max' => 4],
            [['kddekon', 'kdbeban', 'kdjnsban', 'kdctarik', 'carahitung', 'kdheader', 'vol1', 'vol2', 'vol3', 'vol4', 'jumlah2', 'paguphln', 'pagurmp', 'pagurkp', 'kdblokir', 'blokirphln', 'blokirrmp', 'blokirrkp', 'volsbk', 'volrkakl', 'nilkontrak', 'januari', 'pebruari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'nopember', 'desember', 'jmltunda', 'jmlabt', 'kurs', 'indexkpjm'], 'string', 'max' => 1],
            [['register', 'header2', 'sat1', 'sat2', 'sat3', 'sat4', 'rphblokir', 'kdcopy', 'kdabt', 'kdsbu', 'blnkontrak', 'nokontrak', 'kdluncuran', 'norev', 'kdubah'], 'string', 'max' => 10],
            [['nmitem'], 'string', 'max' => 120],
            [['satkeg'], 'string', 'max' => 5],
            [['tgkontrak'], 'string', 'max' => 7],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thang' => 'Thang',
            'kdjendok' => 'Kdjendok',
            'kdsatker' => 'Kdsatker',
            'kddept' => 'Kddept',
            'kdunit' => 'Kdunit',
            'kdprogram' => 'Kdprogram',
            'kdgiat' => 'Kdgiat',
            'kdoutput' => 'Kdoutput',
            'kdlokasi' => 'Kdlokasi',
            'kdkabkota' => 'Kdkabkota',
            'kddekon' => 'Kddekon',
            'kdsoutput' => 'Kdsoutput',
            'kdkmpnen' => 'Kdkmpnen',
            'kdskmpnen' => 'Kdskmpnen',
            'kdakun' => 'Kdakun',
            'kdkppn' => 'Kdkppn',
            'kdbeban' => 'Kdbeban',
            'kdjnsban' => 'Kdjnsban',
            'kdctarik' => 'Kdctarik',
            'register' => 'Register',
            'carahitung' => 'Carahitung',
            'header1' => 'Header1',
            'header2' => 'Header2',
            'kdheader' => 'Kdheader',
            'noitem' => 'Noitem',
            'nmitem' => 'Nmitem',
            'vol1' => 'Vol1',
            'sat1' => 'Sat1',
            'vol2' => 'Vol2',
            'sat2' => 'Sat2',
            'vol3' => 'Vol3',
            'sat3' => 'Sat3',
            'vol4' => 'Vol4',
            'sat4' => 'Sat4',
            'volkeg' => 'Volkeg',
            'satkeg' => 'Satkeg',
            'hargasat' => 'Hargasat',
            'jumlah' => 'Jumlah',
            'jumlah2' => 'Jumlah2',
            'paguphln' => 'Paguphln',
            'pagurmp' => 'Pagurmp',
            'pagurkp' => 'Pagurkp',
            'kdblokir' => 'Kdblokir',
            'blokirphln' => 'Blokirphln',
            'blokirrmp' => 'Blokirrmp',
            'blokirrkp' => 'Blokirrkp',
            'rphblokir' => 'Rphblokir',
            'kdcopy' => 'Kdcopy',
            'kdabt' => 'Kdabt',
            'kdsbu' => 'Kdsbu',
            'volsbk' => 'Volsbk',
            'volrkakl' => 'Volrkakl',
            'blnkontrak' => 'Blnkontrak',
            'nokontrak' => 'Nokontrak',
            'tgkontrak' => 'Tgkontrak',
            'nilkontrak' => 'Nilkontrak',
            'januari' => 'Januari',
            'pebruari' => 'Pebruari',
            'maret' => 'Maret',
            'april' => 'April',
            'mei' => 'Mei',
            'juni' => 'Juni',
            'juli' => 'Juli',
            'agustus' => 'Agustus',
            'september' => 'September',
            'oktober' => 'Oktober',
            'nopember' => 'Nopember',
            'desember' => 'Desember',
            'jmltunda' => 'Jmltunda',
            'kdluncuran' => 'Kdluncuran',
            'jmlabt' => 'Jmlabt',
            'norev' => 'Norev',
            'kdubah' => 'Kdubah',
            'kurs' => 'Kurs',
            'indexkpjm' => 'Indexkpjm',
            'kdib' => 'Kdib',
        ];
    }
}
