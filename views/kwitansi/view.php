<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kwitansi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uang_harian',
            'uang_harian_total',
            'biaya_transportasi',
            'biaya_penginapan',
            'jumlah_pdb',
            'hari_inap_riil',
            'biaya_inap_riil',
            'biaya_inap_riil_total',
            'transport_riil',
            'taksi_riil',
            'representasi_riil',
            'representasi_riil_total',
            'jumlah_riil',
            'tanggal_bayar',
            'kwitansi_path',
            'id_st',
            'nip',
        ],
    ]) ?>

</div>
