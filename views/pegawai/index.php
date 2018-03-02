<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">
    <!-- INPUTS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a('Create Pegawai', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <div style="overflow: auto; overflow-y: hidden; Height:?">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'nip',
                        'nama',
                        'pangkat',
                        'jabatan',
                        'flag_pensiun',
                        //'id_instansi',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>

        </div>
    </div>
</div>
