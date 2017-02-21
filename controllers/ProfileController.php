<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use dektrium\user\controllers\ProfileController as BaseProfileController;
use app\models\LoginStories;
use yii\data\ActiveDataProvider;


/**
 * ProfileController shows users profiles.
 *
 * @property \dektrium\user\Module $module
 */
class ProfileController extends BaseProfileController
{

    /**
     * Shows user's profile.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        $loginStories = new ActiveDataProvider([
            'query' => LoginStories::findLoginsByUserId($id),
        ]);

        return $this->render('show', [
            'profile' => $profile,
            'loginStories' => $loginStories,
            'user' => $profile->user
        ]);
    }
}
