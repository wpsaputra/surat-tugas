<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pegawai;
use app\models\Instansi;

/* @var $this yii\web\View */
/* @var $model app\models\FlagBendahara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flag-bendahara-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip')->widget(Select2::classname(), [
        // 'data' => $data,
        'data' => ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','nama'),
        'options' => ['placeholder' => 'Pilih bendahara saat ini ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'id_instansi')->textInput() ?> -->
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
