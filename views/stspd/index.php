<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StSpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Tugas & SPD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="st-spd-index">
    <!-- INPUTS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a('Create St Spd', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'nomor_st',
                    'tanggal_terbit',
                    'nip',
                    'nomor_spd',
                    //'maksud:ntext',
                    //'kota_asal',
                    //'kota_tujuan',
                    //'tanggal_pergi',
                    //'tanggal_kembali',
                    //'tingkat_perjalanan_dinas',
                    //'id_kendaraan',
                    //'kode_program',
                    //'kode_kegiatan',
                    //'kode_output',
                    //'kode_komponen',
                    //'st_path',
                    //'id_instansi',
                    //'nip_kepala',
                    //'nip_ppk',
                    //'nip_bendahara',
                    //'id_akun',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
