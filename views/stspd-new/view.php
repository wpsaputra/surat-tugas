<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StSpdNew */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'St Spd News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="st-spd-new-view">

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
            'nomor_st',
            'tanggal_terbit',
            'nip',
            'nomor_spd',
            'maksud:ntext',
            'kota_asal',
            'kota_tujuan',
            'tanggal_pergi',
            'tanggal_kembali',
            'tingkat_perjalanan_dinas',
            'id_kendaraan',
            'kode_program',
            'kode_kegiatan',
            'kode_kro',
            'kode_ro',
            'kode_komponen',
            'kode_subkomponen',
            'id_akun',
            'st_path',
            'id_instansi',
            'nip_kepala',
            'nip_ppk',
            'nip_ppk_dukman',
            'nip_bendahara',
            'flag_with_spd',
        ],
    ]) ?>

</div>
