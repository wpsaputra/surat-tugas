<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FlagBendaharaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Flag Bendaharas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flag-bendahara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Flag Bendahara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nip',
            'id_instansi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
