<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\TemplateNew;


/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = 'Create Kwitansi';
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/vendor/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/kwitansi.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$template = json_encode(TemplateNew::find()->where(['nama' => 'kwitansi_luar_kota_new'])->asArray()->one()['html_text']);

?>


<div class="kwitansi-create">
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
var link_multi = <?= json_encode(Yii::$app->urlManager->createUrl('kwitansi/getmulti'));?>;

</script>

