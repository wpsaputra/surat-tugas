<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Komponen */

$this->title = 'Create Komponen';
$this->params['breadcrumbs'][] = ['label' => 'Komponens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komponen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
