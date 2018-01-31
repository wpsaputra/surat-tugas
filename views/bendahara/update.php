<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FlagBendahara */

$this->title = 'Update Flag Bendahara: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Flag Bendaharas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flag-bendahara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
