<?php

namespace app\controllers;

use app\models\LoginStories;
use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\models\LoginForm;
use xj\ua\UserAgent;
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

            $this->saveLoginData();
            //Redirect to personal account page
            return $this->redirect(Url::toRoute('/user/settings/profile'));
        }

        return $this->goHome();
    }

    /**
     * When user logged in - store user login data
     */
    private function saveLoginData()
    {
        //Get user data (ip, time, browser)
        $request = \Yii::$app->getRequest();
        $userData = [
            'ip' => $request->getUserIP(),
            'login_time' => time(),
            'browser' => UserAgent::model()->browser,
            'user_id' => \Yii::$app->user->id
        ];

        //Save it to DB
        $loginStories = new LoginStories();
        $loginStories->attributes = $userData;
        $loginStories->save();
    }
} 