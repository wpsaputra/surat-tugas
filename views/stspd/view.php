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
                // 'id',
                'nomor_st',
                'tanggal_terbit',
                'nip',
                [
                    'attribute' => 'nama_pegawai',
                    'label' => 'Nama Pegawai',
                    'value' => $model->nip0->nama,
                ],
                'nomor_spd',
                'maksud:ntext',
                'kota_asal',
                'kota_tujuan',
                'tanggal_pergi',
                'tanggal_kembali',
                'tingkat_perjalanan_dinas',
                // 'id_kendaraan',
                [
                    'attribute' => 'id_kendaraan',
                    'value' => $model->kendaraan->nama_kendaraan,
                ],
                // // 'kode_program',
                // [
                //     'attribute' => 'kode_program',
                //     // 'value' => str_pad($model->kode_output, 3, '0', STR_PAD_LEFT),
                //     'value' => $model->kodeProgram->kddept.'.'.$model->kodeProgram->kdunit.'.'.$model->kodeProgram->kdprogram,
                // ],
                // // 'kode_kegiatan',
                // [
                //     'attribute' => 'kode_kegiatan',
                //     // 'value' => str_pad($model->kode_output, 3, '0', STR_PAD_LEFT),
                //     'value' => $model->kodeKegiatan->kdgiat,
                // ],
                // // 'kode_output',
                // [
                //     'attribute' => 'kode_output',
                //     // 'value' => str_pad($model->kode_output, 3, '0', STR_PAD_LEFT),
                //     'value' => $model->kodeOutput->kdoutput,
                // ],
                // // 'kode_komponen',
                // [
                //     'attribute' => 'kode_komponen',
                //     // 'value' => str_pad($model->kode_komponen, 3, '0', STR_PAD_LEFT),
                //     'value' => $model->kodeKomponen->kdkmpnen,
                // ],
                // [
                //     'attribute' => 'id_instansi',
                //     'value' => $model->instansi->instansi,
                // ],
                // 'nip_kepala',
                // 'nip_ppk',
                // 'nip_bendahara',
                [
                    'attribute' => 'nip_kepala',
                    'value' => $model->nipKepala->nama,
                ],
                [
                    'attribute' => 'nip_ppk',
                    'value' => $model->nipPpk->nama,
                ],
                [
                    'attribute' => 'nip_bendahara',
                    'value' => $model->nipBendahara->nama,
                ],
                'id_akun',
                // 'flag_with_spd',
                [
                    'attribute' => 'flag_with_spd',
                    'label' => 'Cetak Surat Tugas dan SPD',
                    'value' => (($model->flag_with_spd==1)? "Cetak Surat Tugas & SPD" : "Cetak Surat Tugas Saja"),
                ],
            ],
        ]) ?>
        </div>
    </div>

</div>
