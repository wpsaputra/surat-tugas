<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\StSpd */

$this->title = $model->nomor_st;
$this->params['breadcrumbs'][] = ['label' => 'St Spds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="st-spd-view">
    <!-- INPUTS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <a href="<?php echo Url::to('@web/download/'.$model->st_path);?>" download="<?php echo $model->st_path;?>" class="btn btn-success pull-right">
                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download ST & SPD</a>
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
                'kode_output',
                'kode_komponen',
                'st_path',
                'id_instansi',
                'nip_kepala',
                'nip_ppk',
                'nip_bendahara',
                'id_akun',
            ],
        ]) ?>
        </div>
    </div>

</div>
