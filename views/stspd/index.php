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
            <div style="overflow: auto; overflow-y: hidden; Height:?">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        'nomor_st',
                        'nip',
                        [
                            'attribute' => 'nama_pegawai',
                            'label' => 'Nama Pegawai',
                            'value' => 'nip0.nama'
                        ],
                        [
                            'attribute' => 'id_instansi',
                            'label' => 'Id Instansi',
                            // 'value' => 'nip0.nama'
                        ],
                        // 'id_instansi',
                        'tanggal_terbit',
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
</div>
