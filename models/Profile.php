<?php

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;

class Profile extends BaseProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['lastName'] = ['last_name', 'string', 'max' => 255];
        $rules['phone_number'] = ['phone_number', 'string', 'max' => 255];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = \Yii::t('user', 'First name');
        $labels['last_name'] = \Yii::t('user', 'Last name');
        $labels['phone_number'] = \Yii::t('user', 'Phone number');

        return $labels;
    }
}