<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login_stories".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property string $browser
 * @property integer $login_time
 *
 * @property User $user
 */
class LoginStories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_stories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'login_time'], 'integer'],
            [['ip'], 'string', 'max' => 45],
            [['browser'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'ip' => Yii::t('app', 'Ip'),
            'browser' => Yii::t('app', 'Browser'),
            'login_time' => Yii::t('app', 'Login Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $userId
     * @return $this
     */
    public static function findLoginsByUserId($userId){
        return static::find()->where(['user_id' => $userId]);
    }
}
