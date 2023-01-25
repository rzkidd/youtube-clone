<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login text-light d-flex flex-column align-items-center">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', [
                    'inputOptions' => [
                        'class' => 'form-control bg-transparent text-light'
                    ]
                ])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'class' => 'form-control bg-transparent text-light'
                    ]
                ])->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="text-center">
                    <div class="my-1 mx-0" style="color:#999;">
                        If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                        <br>
                        Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                    </div>
    
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
                    </div>
    
                    <div class="text-muted mt-2">
                        Don't have an account? <?= Html::a('Register', ['/site/signup']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
