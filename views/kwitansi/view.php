<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kwitansi-view">
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
            <a href="<?php echo Url::to('@web/download/'.$model->kwitansi_path);?>" download="<?php echo $model->kwitansi_path;?>" class="btn btn-success pull-right">
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Kwitansi</a>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                // 'id_st',
                [
                    'attribute' => 'id_st',
                    'label' => 'Nomor Surat Tugas',
                    'value' => $model->st->nomor_st,
                ],
                'nip',
                [
                    'attribute' => 'nama_pegawai',
                    'label' => 'Nama Pegawai',
                    'value' => $model->nip0->nama,
                ],
                'jumlah_hari',
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
                // 'kwitansi_path',
            ],
        ]) ?>
        </div>
    </div>

</div>
