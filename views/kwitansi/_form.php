<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use app\models\StSpd;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Pegawai;

/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kwitansi-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'uang_harian')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'uang_harian', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'uang_harian_total')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'biaya_transportasi')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'biaya_transportasi', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'biaya_penginapan')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'biaya_penginapan', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'jumlah_pdb')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'hari_inap_riil')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'hari_inap_riil', [
        'addon' => [ 
            // 'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => 'Hari', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'biaya_inap_riil')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'biaya_inap_riil', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'biaya_inap_riil_total')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'transport_riil')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'transport_riil', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'taksi_riil')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'taksi_riil', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'representasi_riil')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'representasi_riil', [
        'addon' => [ 
            'prepend' => ['content' => 'Rp.', 'options'=>['class'=>'alert-success']],
            'append' => ['content' => ',-', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
        ]
    ]); ?>

    <!-- <?= $form->field($model, 'representasi_riil_total')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'jumlah_riil')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'tanggal_bayar')->textInput() ?> -->
    <?= $form->field($model, 'tanggal_bayar')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <!-- <?= $form->field($model, 'kwitansi_path')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'id_st')->textInput() ?> -->
    <?= $form->field($model, 'id_st')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(StSpd::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'id','nomor_st'),
        'options' => ['placeholder' => 'Pilih pegawai ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','nama'),
        'options' => ['placeholder' => 'Pilih pegawai ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
