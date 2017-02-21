<?php

namespace app\controllers;

use dektrium\user\Module;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use dektrium\user\models\RegistrationForm as RegistrationFormDektrium;
use dektrium\user\models\LoginForm as LoginFormDektrium;
use yii\data\ActiveDataProvider;
use dektrium\user\models\User;

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

        $module = Module::getInstance();

        $registeredUsers = new ActiveDataProvider([
            'query' => User::find(),
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        return $this->render('index', [
            'registrationModel'  => $registrationModel,
            'loginModel' => $loginModel,
            'module' => $module,
            'registeredUsers' => $registeredUsers
        ]);
    }
}
