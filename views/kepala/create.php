<?php

use yii\helpers\Html;
use app\models\Instansi;
use app\models\FlagKepala;
use app\models\Pegawai;


/* @var $this yii\web\View */
/* @var $model app\models\FlagKepala */

$this->title = 'Edit Kepala Kantor';
// $this->params['breadcrumbs'][] = ['label' => 'Flag Kepalas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;

try{
    $instansi = Instansi::find()->select("instansi")->where(['id'=>Yii::$app->user->identity->id_instansi])->asArray()->one()["instansi"];
}catch(Exception $e){
    $instansi = "belum didefinisikan";
}

try{
    $kepala = FlagKepala::find()->select("nip")->where(['id_instansi'=>Yii::$app->user->identity->id_instansi])->one()->nip0->nama;
}catch(Exception $e){
    $kepala = "belum didefinisikan";
}

?>
<div class="flag-kepala-create">
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Form dibawah ini berguna untuk mengubah kepala kantor.
        <p>Kepala kantor <?= $instansi; ?> saat ini adalah <?= $kepala; ?></p>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
