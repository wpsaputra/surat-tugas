<?php

use yii\helpers\Html;
use app\models\StSpd;

/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = 'Update Kwitansi: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->registerJsFile(
    '@web/vendor/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/kwitansi.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

if(StSpd::find()->where(['id' => $model->id_st])->asArray()->one()["id_akun"]==524111){
    // Luar Kota
    $isFieldEnabled = true;
}else{
    $isFieldEnabled = false;
}

?>
<div class="kwitansi-update">
    <div class="row">
        <div class="col-md-5">
            <!-- INPUTS -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                <?= $this->render('_form_update', [
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
var isFieldEnabled = <?= json_encode($isFieldEnabled); ?>;

</script>
