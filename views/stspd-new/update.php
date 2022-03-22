<?php

use yii\helpers\Html;
use app\models\TemplateNew;
use app\models\Instansi;
use app\models\Pegawai;

/* @var $this yii\web\View */
/* @var $model app\models\StSpd */

$this->title = 'Update Surat Tugas & SPD: '.$model->nomor_st;
$this->params['breadcrumbs'][] = ['label' => 'St Spds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->registerJsFile(
    '@web/vendor/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/stspd.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$template = json_encode(TemplateNew::find()->where(['nama' => 'spd_deprecated'])->asArray()->one()['html_text']);
$instansi = json_encode(Instansi::find()->where(['id'=>Yii::$app->user->identity->id_instansi])->asArray()->one()['instansi']);
$pangkat = json_encode(Pegawai::find()->where(['nip'=>$model->nip])->asArray()->one()['pangkat']);
$jabatan = json_encode(Pegawai::find()->where(['nip'=>$model->nip])->asArray()->one()['jabatan']);

$date1 = new \DateTime($model->tanggal_pergi);
$date2 = new \DateTime($model->tanggal_kembali);
$diff = json_encode($date2->diff($date1)->format("%a")+1);

?>
<div class="st-spd-update">
    <div class="row">
        <div class="col-md-5">
            <!-- INPUTS -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                <?= $this->render('_form', [
                    'model' => $model,
                    'modelsAnggota' => $modelsAnggota
                ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <!-- INPUTS -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Preview</h3>
                </div>
                <div class="panel-body">
                    <textarea name="editor1" id=editor1></textarea>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
var x_hari = <?= $diff; ?> + " Hari";
var pangkat = <?= $pangkat; ?>;
var jabatan = <?= $jabatan; ?>;
var template = <?= $template; ?>;
var instansi = <?= $instansi; ?>;
var link = <?= json_encode(Yii::$app->urlManager->createUrl('stspd/getpegawai'));?>;
var link_hari = <?= json_encode(Yii::$app->urlManager->createUrl('stspd/gethari'));?>;
</script>