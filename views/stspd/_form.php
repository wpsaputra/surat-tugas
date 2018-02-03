<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StSpd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="st-spd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor_st')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_terbit')->textInput() ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_spd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maksud')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kota_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kota_tujuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_pergi')->textInput() ?>

    <?= $form->field($model, 'tanggal_kembali')->textInput() ?>

    <?= $form->field($model, 'tingkat_perjalanan_dinas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kendaraan')->textInput() ?>

    <?= $form->field($model, 'kode_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_kegiatan')->textInput() ?>

    <?= $form->field($model, 'kode_output')->textInput() ?>

    <?= $form->field($model, 'kode_komponen')->textInput() ?>

    <?= $form->field($model, 'st_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_instansi')->textInput() ?>

    <?= $form->field($model, 'nip_kepala')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip_ppk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip_bendahara')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_akun')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
