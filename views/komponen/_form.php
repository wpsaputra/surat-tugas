<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Output;

/* @var $this yii\web\View */
/* @var $model app\models\Komponen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="komponen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_komponen')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'id_output')->textInput() ?> -->
    <?= $form->field($model, 'id_output')->widget(Select2::classname(), [
        // 'data' => $data,
        'data' => ArrayHelper::map(Output::find()->all(),'kode','uraian'),
        'options' => ['placeholder' => 'Pilih output dari komponen ...'],
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
