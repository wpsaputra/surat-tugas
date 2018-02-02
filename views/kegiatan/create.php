<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kegiatan */

$this->title = 'Create Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
