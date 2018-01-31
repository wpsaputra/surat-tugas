<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = 'Update Pegawai: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nip, 'url' => ['view', 'id' => $model->nip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
