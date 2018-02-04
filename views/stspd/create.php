<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StSpd */

$this->title = 'Create St Spd';
$this->params['breadcrumbs'][] = ['label' => 'St Spds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="st-spd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsAnggota' => $modelsAnggota
    ]) ?>

</div>
