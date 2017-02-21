<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/**
 * @var yii\web\View              $this
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\RegistrationForm $registrationModel
 * @var dektrium\user\models\LoginForm $LoginModel
 */

$this->title = Yii::t('user', 'Main page');

?>
<?php if (\Yii::$app->user->isGuest): ?>

<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Yii::t('user', 'Sign up') ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'action' => \yii\helpers\Url::toRoute('/user/registration/register'),
                ]); ?>

                <?= $form->field($registrationModel, 'username') ?>

                <?= $form->field($registrationModel, 'email') ?>

                <?= $form->field($registrationModel, 'password')->passwordInput() ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Yii::t('user', 'Sign in') ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'action' => \yii\helpers\Url::toRoute('/user/security/login'),
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                ]) ?>

                    <?= $form->field($loginModel, 'login',
                        ['inputOptions' => ['class' => 'form-control', 'tabindex' => '1']]
                    );
                    ?>

                    <?= $form->field(
                        $loginModel,
                        'password',
                        ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                        ->passwordInput()
                        ->label(
                            Yii::t('user', 'Password')
                            . ($module->enablePasswordRecovery ?
                                ' (' . Html::a(
                                    Yii::t('user', 'Forgot password?'),
                                    ['/user/recovery/request'],
                                    ['tabindex' => '5']
                                )
                                . ')' : '')
                        ) ?>

                <?= $form->field($loginModel, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

                <?= Html::submitButton(
                    Yii::t('user', 'Sign in'),
                    ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
                ) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php if ($module->enableConfirmation): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
        <?php endif ?>
    </div>
</div>
<?php endif ?>

<div class="row">
    <h2><?= Yii::t('user', 'Latest registered users')?></h2>
    <?= GridView::widget([
        'dataProvider' => $registeredUsers,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'created_at:datetime',
            [
                'label'=>'User details',
                'format' => 'raw',
                'value'=>function ($data) {
                        return Html::a(Yii::t('user', 'Details'), ['/user/profile/show', 'id' => $data->id]);
                    },
            ],
        ],
    ]); ?>
</div>
