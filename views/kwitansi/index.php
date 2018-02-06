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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kwitansi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uang_harian',
            'uang_harian_total',
            'biaya_transportasi',
            'biaya_penginapan',
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
