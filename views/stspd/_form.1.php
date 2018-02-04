<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\StSpd */
/* @var $form yii\widgets\ActiveForm */
$js = '
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});

';

$js2 = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJS($js2);

?>

<div class="st-spd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor_st')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_terbit')->textInput() ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_spd')->textInput(['maxlength' => true]) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-queen"></i> Anggota</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsAnggota[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'nip_anggota',
                    'nomor_spd',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsAnggota as $i => $modelAnggota): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Anggota</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelAnggota->isNewRecord) {
                                echo Html::activeHiddenInput($modelAnggota, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelAnggota, "[{$i}]nip_anggota")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelAnggota, "[{$i}]nomor_spd")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

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
