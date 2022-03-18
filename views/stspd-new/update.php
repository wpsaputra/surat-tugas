<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StSpdNew */

$this->title = 'Update St Spd New: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'St Spd News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="st-spd-new-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>