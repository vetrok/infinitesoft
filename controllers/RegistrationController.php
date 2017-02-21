<?php

namespace app\controllers;

use dektrium\user\models\RegistrationForm;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\web\NotFoundHttpException;
use dektrium\user\controllers\RegistrationController as BaseRegistrationController;
use dektrium\user\Module;
use yii\data\ActiveDataProvider;
use dektrium\user\models\LoginForm as LoginFormDektrium;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends BaseRegistrationController
{
    /**
     * Preform registration
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRegister()
    {
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = \Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->request->post()) && $model->register()) {
            $this->trigger(self::EVENT_AFTER_REGISTER, $event);

            return $this->render('/message', [
                'title'  => \Yii::t('user', 'Your account has been created'),
                'module' => $this->module,
            ]);
        }

        /** @var LoginFormDektrium $loginModel */
        $loginModel = \Yii::createObject(LoginFormDektrium::className());
        /** @var  $module */
        $module = Module::getInstance();
        /** @var ActiveDataProvider $registeredUsers */
        $registeredUsers = \Yii::createObject(ActiveDataProvider::className());

        return $this->render('@app/views/site/index', [
            'registrationModel'  => $model,
            'loginModel' => $loginModel,
            'module' => $module,
            'registeredUsers' => $registeredUsers
        ]);
    }
}
