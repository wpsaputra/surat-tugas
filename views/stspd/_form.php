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
use app\models\FlagPpkDukman;
use app\models\Instansi;
use app\models\StSpdAnggota;
use kartik\date\DatePicker;
use app\models\TProgram;

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
		url: "' . Yii::$app->urlManager->createUrl('stspd/getrkakl') . '",
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



$arr_ppk_dukman = ArrayHelper::map(FlagPpkDukman::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','id_instansi');
foreach ($arr_ppk_dukman as $key => $value) {
    $arr_ppk_dukman[$key] = Pegawai::findOne($key)->nama;
}

$arr_ppk_gabung = array_replace($arr_ppk, $arr_ppk_dukman);

$arr_bendahara = ArrayHelper::map(FlagBendahara::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->all(),'nip','id_instansi');
foreach ($arr_bendahara as $key => $value) {
    $arr_bendahara[$key] = Pegawai::findOne($key)->nama;
}

$arr_model_attr = array_keys($model->attributes);
$arr_model_val = array_values($model->attributes);

$js5 = '$("#stspd-xkode_program").on("change", function() {
	var value = $(this).val();
    console.log("xkode_program", value);

    var ppk_ppis ='.json_encode($arr_ppk).';
    var ppk_dukman ='.json_encode($arr_ppk_dukman).';
    
    $("#stspd-nip_ppk option:gt(0)").remove();
    var $el = $("#stspd-nip_ppk");

    if(value==1){
        //SHOW PPK PPIS
        $.each(ppk_ppis, function(key,value) {
            $el.append($("<option></option>")
               .attr("value", key).text(value));
        });

    }else{
        //PPK DUKMAN
        $.each(ppk_dukman, function(key,value) {
            $el.append($("<option></option>")
               .attr("value", key).text(value));
        });

    }
});';
$this->registerJS($js5);


// print_r($arr_model_attr);
// print_r(Pegawai::find()->asArray()->one());

// $arr_pegawai = Pegawai::find()->where(['nip'=>$model->nip])->asArray()->one();
// print_r($arr_pegawai);

// $bulan = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
// print_r($bulan[Yii::$app->formatter->asDate($model->tanggal_terbit, "M")]);

// print_r(StSpdAnggota::find()->where(['id_st_spd'=>$model->id])->asArray()->all());

// New Program, kegiatan, output, komponen
$thang = Date('Y');
$kdsatker = Instansi::find()->where(['id'=> Yii::$app->user->identity->id_instansi])->asArray()->one()['unit_kerja'];

$arr_prg = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS prg FROM su_t_new_program WHERE tahun='".$thang."'")->queryAll();
$arr_keg = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS keg FROM su_t_new_kegiatan WHERE tahun='".$thang."'")->queryAll();
$arr_kro = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS kro FROM su_t_new_kro WHERE tahun='".$thang."'")->queryAll();
$arr_ro = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS ro FROM su_t_new_ro WHERE tahun='".$thang."'")->queryAll();
$arr_komponen = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS komponen FROM su_t_new_komponen WHERE tahun='".$thang."'")->queryAll();
$arr_subkomponen = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS subkomponen FROM su_t_new_sub_komponen WHERE tahun='".$thang."'")->queryAll();
$arr_akun = Yii::$app->db->createCommand("SELECT *, CONCAT(kode, ' - ', deskripsi) AS akun FROM su_t_new_akun WHERE tahun='".$thang."'")->queryAll();

?>

<?= Html::errorSummary($model, ['encode' => false, 'class' => 'alert alert-danger']) ?>

<div class="st-spd-form">

    <?php $form = ActiveForm::begin(['id' => 'ISSUE-form']); ?>

    <?= $form->field($model, 'nomor_st')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'tanggal_terbit')->textInput() ?> -->
    <?= $form->field($model, 'tanggal_terbit')->widget(DatePicker::classname(), [
        //'language' => 'ru',
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
        'removeButton' => false,
        'pluginOptions' => [
        'autoclose'=>true,
        // 'format' => 'mm/dd/yyyy'
        'format' => 'M dd, yyyy'
        ]
    ]) ?>

    <div class="row">
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, 'nip')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->andWhere(["flag_pensiun"=>0])->orderBy(["nama"=>"SORT_ASC"])->all(),'nip','nama'),
                'options' => ['placeholder' => 'Pilih pegawai ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'nomor_spd')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php DynamicFormWidget::begin([
        // 'id' => 'dynamic-form',
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 6, // the maximum times, an element can be cloned (default 999)
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
            <button type="button" class="pull-right add-item btn btn-success btn-xs" style="color:#41B314"><i class="fa fa-plus"></i> Tambah anggota</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsAnggota as $index => $modelAnggota): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Anggota: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs" style="color:#d9534f;"><i class="fa fa-minus"></i></button>
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
                                    ArrayHelper::map(Pegawai::find()->where(["id_instansi" => Yii::$app->user->identity->id_instansi])->andWhere(["flag_pensiun"=>0])->orderBy(["nama"=>"SORT_ASC"])->all(),'nip','nama'),
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

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'kota_asal')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'kota_tujuan')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'tanggal_pergi')->textInput() ?> -->
            <?= $form->field($model, 'tanggal_pergi')->widget(DatePicker::classname(), [
                //'language' => 'ru',
                // 'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control'],
                'removeButton' => false,
                'pluginOptions' => [
                'autoclose'=>true,
                // 'format' => 'mm/dd/yyyy'
                'format' => 'M dd, yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'tanggal_kembali')->textInput() ?> -->
            <?= $form->field($model, 'tanggal_kembali')->widget(DatePicker::classname(), [
                //'language' => 'ru',
                // 'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control'],
                'removeButton' => false,
                'pluginOptions' => [
                'autoclose'=>true,
                // 'format' => 'mm/dd/yyyy'
                'format' => 'M dd, yyyy'
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'tingkat_perjalanan_dinas')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, "tingkat_perjalanan_dinas")->dropDownList(
                ["B"=>"B", "C"=>"C"],
                ['prompt'=>'Pilih tingkat perjalanan dinas ...']
            )?>
        </div>
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'id_kendaraan')->textInput() ?> -->
            <?= $form->field($model, 'id_kendaraan')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Kendaraan::find()->all(),'id','nama_kendaraan'),
                'options' => ['placeholder' => 'Pilih kendaraan ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'xkode_program')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, 'xkode_program')->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map(TNewProgram::find()->where(["tahun"=>Date("Y")])->all(),'id','kode'),
                'data' => ArrayHelper::map($arr_prg,'id','prg'),
                'options' => ['placeholder' => 'Pilih program ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_kegiatan', 'id'=>"stspd-xkode_program"],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'xkode_kegiatan')->textInput() ?> -->
            <?= $form->field($model, 'xkode_kegiatan')->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map(Kegiatan::find()->all(),'kode','uraian'),
                'data' => ArrayHelper::map($arr_keg,'id','keg'),
                'options' => ['placeholder' => 'Pilih kegiatan ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_output'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'xkode_kro')->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map(Output::find()->all(),'kode','uraian'),
                'data' => ArrayHelper::map($arr_kro,'id','kro'),
                'options' => ['placeholder' => 'Pilih Output ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_komponen'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <!-- <?= $form->field($model, 'xkode_ro')->textInput() ?> -->
            <?= $form->field($model, 'xkode_ro')->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map(Komponen::find()->all(),'id','uraian'),
                'data' => ArrayHelper::map($arr_ro,'id','ro'),
                'options' => ['placeholder' => 'Pilih Komponen ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'xkode_komponen')->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map(Output::find()->all(),'kode','uraian'),
                'data' => ArrayHelper::map($arr_komponen,'id','komponen'),
                'options' => ['placeholder' => 'Pilih Output ...', 'class' => 'dependent-input form-control', 'data-next' => 'stspd-kode_komponen'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'xkode_subkomponen')->widget(Select2::classname(), [
                // 'data' => ArrayHelper::map(Komponen::find()->all(),'id','uraian'),
                'data' => ArrayHelper::map($arr_subkomponen,'id','subkomponen'),
                'options' => ['placeholder' => 'Pilih Komponen ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>


    <!-- <?= $form->field($model, 'st_path')->textInput(['maxlength' => true]) ?> -->

    <div class="row">
        <div class="col-sm-4">
            <!-- <?= $form->field($model, 'nip_kepala')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, 'nip_kepala')->widget(Select2::classname(), [
                'data' => $arr_kepala,
                'options' => ['placeholder' => 'Pilih kepala ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-4">
            <!-- <?= $form->field($model, 'nip_ppk')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, "nip_ppk")->dropDownList(
                $arr_ppk_gabung,
                ['prompt'=>'Pilih pegawai ...', "id"=>"stspd-nip_ppk"]
            )?>
        </div>
        <div class="col-sm-4">
            <!-- <?= $form->field($model, 'nip_bendahara')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, 'nip_bendahara')->widget(Select2::classname(), [
                'data' => $arr_bendahara,
                'options' => ['placeholder' => 'Pilih pegawai ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>

    <!-- <?= $form->field($model, 'xid_akun')->textInput() ?> -->
    <?= $form->field($model, 'xid_akun')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($arr_akun,'id','akun'),
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

    <div class="row">
        <div class="col-sm-12">
            <!-- <?= $form->field($model, 'tingkat_perjalanan_dinas')->textInput(['maxlength' => true]) ?> -->
            <?= $form->field($model, "flag_with_spd")->dropDownList(
                [0=>"Cetak Surat Tugas Saja", 1=>"Cetak Surat Tugas & SPD"],
                ['prompt'=>'Pilih jenis surat tugas ...']
            )?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
