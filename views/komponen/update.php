<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Komponen */

$this->title = 'Update Komponen: '.$model->kode_komponen;
$this->params['breadcrumbs'][] = ['label' => 'Komponens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="komponen-update">
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
