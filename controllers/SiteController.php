<?php

namespace app\controllers;

use dektrium\user\Module;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use dektrium\user\models\RegistrationForm as RegistrationFormDektrium;
use dektrium\user\models\LoginForm as LoginFormDektrium;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //Registration requirements
        /** @var RegistrationForm $registrationModel */
        $registrationModel = \Yii::createObject(RegistrationFormDektrium::className());
        //Login requirements
        /** @var LoginForm $loginModel */
        $loginModel = \Yii::createObject(LoginFormDektrium::className());
        /** @var  $module */
        $module = Module::getInstance();
        /** @var ActiveDataProvider $registeredUsers */
        $registeredUsers = \Yii::createObject(ActiveDataProvider::className());

        return $this->render('index', [
            'registrationModel'  => $registrationModel,
            'loginModel' => $loginModel,
            'module' => $module,
            'registeredUsers' => $registeredUsers
        ]);
    }
}
