<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StSpd */

$this->title = 'Create Surat Tugas & SPD';
$this->params['breadcrumbs'][] = ['label' => 'St Spds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="st-spd-create">
    <!-- INPUTS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
            'modelsAnggota' => $modelsAnggota
        ]) ?>
        </div>
    </div>

</div>
