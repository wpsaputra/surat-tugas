<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StSpdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="st-spd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomor_st') ?>

    <?= $form->field($model, 'tanggal_terbit') ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nomor_spd') ?>

    <?php // echo $form->field($model, 'maksud') ?>

    <?php // echo $form->field($model, 'kota_asal') ?>

    <?php // echo $form->field($model, 'kota_tujuan') ?>

    <?php // echo $form->field($model, 'tanggal_pergi') ?>

    <?php // echo $form->field($model, 'tanggal_kembali') ?>

    <?php // echo $form->field($model, 'tingkat_perjalanan_dinas') ?>

    <?php // echo $form->field($model, 'id_kendaraan') ?>

    <?php // echo $form->field($model, 'kode_program') ?>

    <?php // echo $form->field($model, 'kode_kegiatan') ?>

    <?php // echo $form->field($model, 'kode_output') ?>

    <?php // echo $form->field($model, 'kode_komponen') ?>

    <?php // echo $form->field($model, 'st_path') ?>

    <?php // echo $form->field($model, 'id_instansi') ?>

    <?php // echo $form->field($model, 'nip_kepala') ?>

    <?php // echo $form->field($model, 'nip_ppk') ?>

    <?php // echo $form->field($model, 'nip_bendahara') ?>

    <?php // echo $form->field($model, 'id_akun') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
