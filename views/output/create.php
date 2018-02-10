<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Output */

$this->title = 'Create Output';
$this->params['breadcrumbs'][] = ['label' => 'Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="output-create">
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
