<?php

use app\models\FlagKepala;
use app\models\Instansi;
use app\models\FlagPpk;
use app\models\FlagBendahara;

/* @var $this yii\web\View */

$this->title = 'SPD Online';

try{
    $kepala = FlagKepala::find()->select("nip")->where(['id_instansi'=>Yii::$app->user->identity->id_instansi])->one()->nip0->nama;
}catch(Exception $e){
    $kepala = "Undefined";
}

try{
    $bendahara = FlagBendahara::find()->select("nip")->where(['id_instansi'=>Yii::$app->user->identity->id_instansi])->one()->nip0->nama;
}catch(Exception $e){
    $bendahara = "Undefined";
}

try{
    $ppk = FlagPpk::find()->select("nip")->where(['id_instansi'=>Yii::$app->user->identity->id_instansi])->one()->nip0->nama;
}catch(Exception $e){
    $ppk = "Undefined";
}

try{
    $instansi = Instansi::find()->select("instansi")->where(['id'=>Yii::$app->user->identity->id_instansi])->asArray()->one()["instansi"];
}catch(Exception $e){
    $instansi = "Undefined";
}

try{
    $sql = "SELECT * FROM su_st_spd s WHERE s.id_instansi=".Yii::$app->user->identity->id_instansi." AND YEAR(tanggal_terbit)=".Date('Y')."";
    $count_tahunan = Yii::$app->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();

}catch(Exception $e){
    $count_tahunan = "Undefined";
}

try{
    $sql = "SELECT * FROM su_st_spd s WHERE s.id_instansi=".Yii::$app->user->identity->id_instansi." AND YEAR(tanggal_terbit)=".Date('Y')." AND MONTH(tanggal_terbit)=".Date('m')."";
    $count_bulanan = Yii::$app->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar();

}catch(Exception $e){
    $count_bulanan = "Undefined";
}

if($kepala=='Undefined'||$ppk=='Undefined'||$bendahara=='Undefined'){
    Yii::$app->getSession()->setFlash(
        'error','Kepala / Bendahara / PPK belum disetting. Silahkan edit kepala/bendahara/ppk di menu Pegawai'
    );
}


?>
<!-- OVERVIEW -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">SPD Online Overview</h3>
        <!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-id-card"></i></span>
                    <p>
                        <span class="number">Kepala</span>
                        <span class="title"><?= $kepala ?></span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-id-card"></i></span>
                    <p>
                        <span class="number">Bendahara</span>
                        <span class="title"><?= $bendahara ?></span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-id-card"></i></span>
                    <p>
                        <span class="number">PPK</span>
                        <span class="title"><?= $ppk ?></span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-id-card"></i></span>
                    <p>
                        <span class="number">Instansi</span>
                        <span class="title"><?= $instansi ?></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <!-- <div id="headline-chart" class="ct-chart"></div> -->
            </div>
            <div class="col-md-3">
                <div class="weekly-summary text-right">
                    <span class="number"><?= $count_tahunan;?></span> 
                    <!-- <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span> -->
                    <span class="info-label">Total Surat Tugas (<?= Date('Y');?>)</span>
                </div>
                <div class="weekly-summary text-right">
                    <span class="number"><?= $count_bulanan;?></span> 
                    <!-- <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span> -->
                    <span class="info-label">Total Surat Tugas (<?= Date('F').' '.Date('Y');?>)</span>
                </div>
                <!-- <div class="weekly-summary text-right">
                    <span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
                    <span class="info-label">Total Income</span>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- END OVERVIEW -->