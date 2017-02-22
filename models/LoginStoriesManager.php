<?php

namespace app\models;

use xj\ua\UserAgent;
use app\models\interfaces\AbstractLoginStoriesManager;

/**
 * Class LoginStoriesManager
 * @package app\models
 */
class LoginStoriesManager implements AbstractLoginStoriesManager
{
    /**
     * When user logged in - store user login data
     */
    public function saveLoginData()
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