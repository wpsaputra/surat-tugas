<?php

use yii\helpers\Html;
use app\models\TemplateNew;
use app\models\Instansi;


/* @var $this yii\web\View */
/* @var $model app\models\StSpd */

$this->title = 'Create Surat Tugas & SPD';
$this->params['breadcrumbs'][] = ['label' => 'St Spds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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

?>
<div class="st-spd-create">

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
var x_hari = 0;
var pangkat = '';
var jabatan = '';
var template = <?= $template; ?>;
var instansi = <?= $instansi; ?>;
var link = <?= json_encode(Yii::$app->urlManager->createUrl('stspd/getpegawai'));?>;
var link_hari = <?= json_encode(Yii::$app->urlManager->createUrl('stspd/gethari'));?>;
</script>