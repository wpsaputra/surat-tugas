<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KomponenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Komponens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="komponen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Komponen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_komponen',
            'uraian',
            'id_output',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
