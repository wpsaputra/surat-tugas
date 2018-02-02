<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Output */

$this->title = 'Update Output: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="output-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
