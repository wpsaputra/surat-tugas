<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Instansi;
use kartik\select2\Select2;
use app\models\Pegawai;

/* @var $this yii\web\View */
/* @var $model app\models\FlagKepala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flag-kepala-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip')->widget(Select2::classname(), [
        // 'data' => $data,
        'data' => ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->andWhere(["flag_pensiun"=>0])->orderBy(["nama"=>"SORT_ASC"])->all(),'nip','nama'),
        'options' => ['placeholder' => 'Pilih kepala kantor saat ini ...'],
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
