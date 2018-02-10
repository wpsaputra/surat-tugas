<?php

use yii\helpers\Html;
use app\models\Instansi;
use app\models\FlagBendahara;


/* @var $this yii\web\View */
/* @var $model app\models\FlagBendahara */

$this->title = 'Edit Bendahara';
// $this->params['breadcrumbs'][] = ['label' => 'Flag Bendaharas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;

try{
    $instansi = Instansi::find()->select("instansi")->where(['id'=>Yii::$app->user->identity->id_instansi])->asArray()->one()["instansi"];
}catch(Exception $e){
    $instansi = "belum didefinisikan";
}

try{
    $bendahara = FlagBendahara::find()->select("nip")->where(['id_instansi'=>Yii::$app->user->identity->id_instansi])->one()->nip0->nama;
}catch(Exception $e){
    $bendahara = "belum didefinisikan";
}

?>
<div class="flag-bendahara-create">
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Form dibawah ini berguna untuk mengubah bendahara.
        <p>Bendahara <?= $instansi; ?> saat ini adalah <?= $bendahara; ?></p>
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
