<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\web\View;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pegawai;
use app\models\FlagKepala;
use app\models\FlagPpk;
use app\models\FlagBendahara;
use app\models\StSpd;
use kartik\typeahead\Typeahead;
use app\models\Program;
use app\models\Kegiatan;
use app\models\Output;
use app\models\Komponen;
use app\models\Kendaraan;
use app\models\Akun;
use app\models\Instansi;

/* @var $this yii\web\View */
/* @var $model app\models\StSpd */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Anggota: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Anggota: " + (index + 1))
    });
});
';

$js2 = '$(".dependent-input").on("change", function() {
	var value = $(this).val(),
		obj = $(this).attr("id"),
        next = $(this).attr("data-next");
        console.log(next);
	$.ajax({
		url: "' . Yii::$app->urlManager->createUrl('stspd/get') . '",
		data: {value: value, obj: obj},
		type: "POST",
		success: function(data) {
			$("#" + next).html(data);
		}
	});
});';

$this->registerJS($js);
$this->registerJS($js2);

$arr_kepala = ArrayHelper::map(FlagKepala::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','id_instansi');
foreach ($arr_kepala as $key => $value) {
    $arr_kepala[$key] = Pegawai::findOne($key)->nama;
}

$arr_ppk = ArrayHelper::map(FlagPpk::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','id_instansi');
foreach ($arr_ppk as $key => $value) {
    $arr_ppk[$key] = Pegawai::findOne($key)->nama;
}

$arr_bendahara = ArrayHelper::map(FlagBendahara::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','id_instansi');
foreach ($arr_bendahara as $key => $value) {
    $arr_bendahara[$key] = Pegawai::findOne($key)->nama;
}

?>

<div class="st-spd-form">

    <?php $form = ActiveForm::begin(['id' => 'ISSUE-form']); ?>

    <?= $form->field($model, 'nomor_st')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'tanggal_terbit')->textInput() ?> -->
    <?= $form->field($model, 'tanggal_terbit')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <!-- <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','nama'),
        'options' => ['placeholder' => 'Pilih pegawai ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?= $form->field($model, 'nomor_spd')->textInput(['maxlength' => true]) ?>

    <?php DynamicFormWidget::begin([
        // 'id' => 'dynamic-form',
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAnggota[0],
        // 'formId' => 'dynamic-form',
        'formId' => 'ISSUE-form',
        'formFields' => [
            'nip_anggota',
            'nomor_spd',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Anggota
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah anggota</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsAnggota as $index => $modelAnggota): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Anggota: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelAnggota->isNewRecord) {
                                echo Html::activeHiddenInput($modelAnggota, "[{$index}]id");
                            }
                        ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- <?= $form->field($modelAnggota, "[{$index}]nip_anggota")->textInput(['maxlength' => true]) ?> -->
                                <?= $form->field($modelAnggota, "[{$index}]nip_anggota")->dropDownList(
                                    ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','nama'),
                                    ['prompt'=>'Pilih pegawai ...']
                                )?>

                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelAnggota, "[{$index}]nomor_spd")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>


    <?= $form->field($model, 'maksud')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kota_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kota_tujuan')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'tanggal_pergi')->textInput() ?> -->
    <?= $form->field($model, 'tanggal_pergi')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <!-- <?= $form->field($model, 'tanggal_kembali')->textInput() ?> -->
    <?= $form->field($model, 'tanggal_kembali')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <!-- <?= $form->field($model, 'tingkat_perjalanan_dinas')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, "tingkat_perjalanan_dinas")->dropDownList(
        ["B"=>"B", "C"=>"C"],
        ['prompt'=>'Pilih tingkat perjalanan dinas ...']
    )?>

    <!-- <?= $form->field($model, 'id_kendaraan')->textInput() ?> -->
    <?= $form->field($model, 'id_kendaraan')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Kendaraan::find()->all(),'id','nama_kendaraan'),
        'options' => ['placeholder' => 'Pilih kendaraan ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'kode_program')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'kode_program')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Program::find()->all(),'kode','uraian'),
        'options' => ['placeholder' => 'Pilih program ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_kegiatan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'kode_kegiatan')->textInput() ?> -->
    <?= $form->field($model, 'kode_kegiatan')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Kegiatan::find()->all(),'kode','uraian'),
        'options' => ['placeholder' => 'Pilih kegiatan ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_output'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'kode_output')->textInput() ?> -->
    <?= $form->field($model, 'kode_output')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Output::find()->all(),'kode','uraian'),
        'options' => ['placeholder' => 'Pilih Output ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_komponen'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'kode_komponen')->textInput() ?> -->
    <?= $form->field($model, 'kode_komponen')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Komponen::find()->all(),'id','uraian'),
        'options' => ['placeholder' => 'Pilih Komponen ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'st_path')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'nip_kepala')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip_kepala')->widget(Select2::classname(), [
        'data' => $arr_kepala,
        'options' => ['placeholder' => 'Pilih kepala ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'nip_ppk')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip_ppk')->widget(Select2::classname(), [
        'data' => $arr_ppk,
        'options' => ['placeholder' => 'Pilih pegawai ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'nip_bendahara')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nip_bendahara')->widget(Select2::classname(), [
        'data' => $arr_bendahara,
        'options' => ['placeholder' => 'Pilih pegawai ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <!-- <?= $form->field($model, 'id_akun')->textInput() ?> -->
    <?= $form->field($model, 'id_akun')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Akun::find()->all(),'id','uraian'),
        'options' => ['placeholder' => 'Pilih akun ...'],
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
