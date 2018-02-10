<?php

use yii\helpers\Html;
use app\models\FlagPpk;
use app\models\Instansi;


/* @var $this yii\web\View */
/* @var $model app\models\FlagPpk */

$this->title = 'Edit PPK';
// $this->params['breadcrumbs'][] = ['label' => 'Flag Ppks', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;

try{
    $instansi = Instansi::find()->select("instansi")->where(['id'=>Yii::$app->user->identity->id_instansi])->asArray()->one()["instansi"];
}catch(Exception $e){
    $instansi = "belum didefinisikan";
}

try{
    $ppk = FlagPpk::find()->select("nip")->where(['id_instansi'=>Yii::$app->user->identity->id_instansi])->one()->nip0->nama;
}catch(Exception $e){
    $ppk = "belum didefinisikan";
}

?>
<div class="flag-ppk-create">
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Form dibawah ini berguna untuk mengubah PPK.
        <p>PPK <?= $instansi; ?> saat ini adalah <?= $ppk; ?></p>
    </div>

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
