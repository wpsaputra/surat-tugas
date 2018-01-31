<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Instansi;
use yii\helpers\ArrayHelper;
use kartik\typeahead\Typeahead;
use app\models\Pegawai;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */

$pangkat = Pegawai::find()->select('pangkat')->distinct()->asArray()->all();
$pangkat = ArrayHelper::getColumn($pangkat, 'pangkat');

$jabatan = Pegawai::find()->select('jabatan')->distinct()->asArray()->all();
$jabatan = ArrayHelper::getColumn($jabatan, 'jabatan');

?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'pangkat')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'pangkat')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => $pangkat,
                'limit' => 10
            ]
        ],
        'defaultSuggestions' => $pangkat,
        'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Filter as you type ...'],
    ]);?>

    <!-- <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'jabatan')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => $jabatan,
                'limit' => 10
            ]
        ],
        'defaultSuggestions' => $jabatan,
        'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Filter as you type ...'],
    ]);?>

    <!-- <?= $form->field($model, 'flag_pensiun')->textInput() ?> -->
    <?= $form->field($model, 'flag_pensiun')->dropDownList(
        [0=>'Belum Pensiun', 1=>'Sudah Pensiun'],
        ['prompt'=>'Pilih Status Pegawai']
    )?>

    <!-- <?= $form->field($model, 'id_instansi')->textInput() ?> -->
    <!-- <?= $form->field($model, 'id_instansi')->dropDownList(
        ArrayHelper::map(Instansi::find()->all(),'id','instansi'),
        ['prompt'=>'Pilih Instansi Pegawai']
    )?> -->

    <?php
        if(Yii::$app->user->identity->role==99){
            echo $form->field($model, 'id_instansi')->dropDownList(
                ArrayHelper::map(Instansi::find()->all(),'id','instansi'),
                ['prompt'=>'Pilih Instansi Pegawai']
            );
        } 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
