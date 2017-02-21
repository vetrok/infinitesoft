<?php

namespace app\controllers;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\models\LoginForm;
use yii\helpers\Url;
use dektrium\user\Module;
use dektrium\user\models\RegistrationForm as RegistrationFormDektrium;
use yii\data\ActiveDataProvider;

class SecurityController extends BaseSecurityController
{
    /**
     * Login user and redirect to my account page
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);

            //Redirect to personal account page
            return $this->redirect(Url::toRoute('/user/settings/profile'));
        }

        /** @var RegistrationFormDektrium $registrationModel */
        $registrationModel = \Yii::createObject(RegistrationFormDektrium::className());
        /** @var  $module */
        $module = Module::getInstance();
        /** @var ActiveDataProvider $registeredUsers */
        $registeredUsers = \Yii::createObject(ActiveDataProvider::className());

        return $this->render('@app/views/site/index', [
            'registrationModel'  => $registrationModel,
            'loginModel' => $model,
            'module' => $module,
            'registeredUsers' => $registeredUsers
        ]);
    }
} 