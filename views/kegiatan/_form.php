<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Program;

/* @var $this yii\web\View */
/* @var $model app\models\Kegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'id_prog')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'id_prog')->widget(Select2::classname(), [
        // 'data' => $data,
        'data' => ArrayHelper::map(Program::find()->all(),'kode','uraian'),
        'options' => ['placeholder' => 'Pilih program dari kegiatan ...'],
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
