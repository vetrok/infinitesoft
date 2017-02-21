<?php

namespace app\controllers;

use dektrium\user\Module;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use dektrium\user\models\RegistrationForm as RegistrationFormDektrium;
use dektrium\user\models\LoginForm as LoginFormDektrium;
use yii\data\ActiveDataProvider;
use dektrium\user\models\User;




class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
