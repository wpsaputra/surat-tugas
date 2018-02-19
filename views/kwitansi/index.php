<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KwitansiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kwitansis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kwitansi-index">
    <!-- INPUTS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a('Create Kwitansi', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    [
                        'attribute' => 'nomor_st',
                        'label' => 'Nomor Surat Tugas',
                        'value' => 'st.nomor_st'
                    ],
                    'nip',
                    [
                        'attribute' => 'nama_pegawai',
                        'label' => 'Nama Pegawai',
                        'value' => 'nip0.nama'
                    ],
                    [
                        'attribute' => 'id_instansi',
                        'label' => 'Id Instansi',
                        'value' => 'st.id_instansi'
                    ],
                    'uang_harian',
                    'uang_harian_total',
                    // 'biaya_transportasi',
                    // 'biaya_penginapan',
                    
                    //'jumlah_pdb',
                    //'hari_inap_riil',
                    //'biaya_inap_riil',
                    //'biaya_inap_riil_total',
                    //'transport_riil',
                    //'taksi_riil',
                    //'representasi_riil',
                    //'representasi_riil_total',
                    //'jumlah_riil',
                    //'tanggal_bayar',
                    //'kwitansi_path',
                    //'id_st',
                    //'nip',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
