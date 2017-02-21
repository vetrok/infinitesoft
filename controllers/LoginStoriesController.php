<?php

namespace app\controllers;

use Yii;
use app\models\LoginStories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * LoginStoriesController implements the CRUD actions for LoginStories model.
 */
class LoginStoriesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index'],
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all LoginStories models.
     * @return mixed
     */
    public function actionIndex()
    {
        //TODO: check logged in user
//        if (\Yii::$app->user->isGuest) {
//            $this->goHome();
//        }

        $dataProvider = new ActiveDataProvider([
            'query' => LoginStories::findLoginsByUserId(\Yii::$app->user->id),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
