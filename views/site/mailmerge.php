<?php

use app\models\FlagKepala;
use app\models\Instansi;
use app\models\FlagPpk;
use app\models\FlagBendahara;

/* @var $this yii\web\View */

$this->title = 'SPD Online';

Yii::$app->getSession()->setFlash(
    'warning','Fitur mail merge ini masih dalam tahap beta'
);
?>
<!-- OVERVIEW -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Mail Merge</h3>
        <!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <iframe style="height: 800px; width: 100%;" src="https://docs.google.com/spreadsheets/d/100z7JzMTM5LUxqaw7qurXbQRMvxSUY44B9nsA0Er7nA/edit?usp=sharing"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- END OVERVIEW -->