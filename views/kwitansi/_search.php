<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KwitansiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kwitansi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uang_harian') ?>

    <?= $form->field($model, 'uang_harian_total') ?>

    <?= $form->field($model, 'biaya_transportasi') ?>

    <?= $form->field($model, 'biaya_penginapan') ?>

    <?php // echo $form->field($model, 'jumlah_pdb') ?>

    <?php // echo $form->field($model, 'hari_inap_riil') ?>

    <?php // echo $form->field($model, 'biaya_inap_riil') ?>

    <?php // echo $form->field($model, 'biaya_inap_riil_total') ?>

    <?php // echo $form->field($model, 'transport_riil') ?>

    <?php // echo $form->field($model, 'taksi_riil') ?>

    <?php // echo $form->field($model, 'representasi_riil') ?>

    <?php // echo $form->field($model, 'representasi_riil_total') ?>

    <?php // echo $form->field($model, 'jumlah_riil') ?>

    <?php // echo $form->field($model, 'tanggal_bayar') ?>

    <?php // echo $form->field($model, 'kwitansi_path') ?>

    <?php // echo $form->field($model, 'id_st') ?>

    <?php // echo $form->field($model, 'nip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
