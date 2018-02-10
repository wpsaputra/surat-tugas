<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Komponen */

$this->title = 'Create Komponen';
$this->params['breadcrumbs'][] = ['label' => 'Komponens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komponen-create">
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
