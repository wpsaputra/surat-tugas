<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Output */

$this->title = 'Create Output';
$this->params['breadcrumbs'][] = ['label' => 'Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="output-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
