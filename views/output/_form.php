<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Kegiatan;

/* @var $this yii\web\View */
/* @var $model app\models\Output */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="output-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'id_kegiatan')->textInput() ?> -->
    <?= $form->field($model, 'id_kegiatan')->widget(Select2::classname(), [
        // 'data' => $data,
        'data' => ArrayHelper::map(Kegiatan::find()->all(),'kode','uraian'),
        'options' => ['placeholder' => 'Pilih kegiatan dari output ...'],
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
