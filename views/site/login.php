<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-12\">{input}</div>\n<div class=\"col-md-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Username'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>

        <!-- <div class="form-group clearfix"> -->
        <!-- </div> -->
        <div class="col-md-12">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<label class=\"fancy-checkbox pull-left\">{input} <span>Remember me</span></label>",
            'class' => "clear-fix"
        ]) ?>

        </div>

        <div class="form-group">
            <!-- <div class="col-lg-offset-1 col-lg-11"> -->
            <div class="col-md-12">
                <?= Html::submitButton('LOGIN', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
