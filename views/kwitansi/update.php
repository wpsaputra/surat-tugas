<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = 'Update Kwitansi: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kwitansi-update">
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
