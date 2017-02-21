<?php

namespace app\controllers;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\models\LoginForm;
use yii\helpers\Url;

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

        return $this->goHome();
    }
} 