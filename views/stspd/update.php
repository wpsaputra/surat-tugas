<?php

use yii\helpers\Html;
use app\models\TemplateNew;

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

<script>
var template = <?= $template; ?>;
</script>