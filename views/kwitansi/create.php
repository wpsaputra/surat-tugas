<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = 'Create Kwitansi';
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kwitansi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
