<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kwitansi */

$this->title = 'Create Kwitansi';
$this->params['breadcrumbs'][] = ['label' => 'Kwitansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kwitansi-create">
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <!-- INPUTS -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Preview</h3>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>

    

</div>
