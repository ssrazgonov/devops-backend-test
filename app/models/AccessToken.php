<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AccessToken extends ActiveRecord
{
    public $tokenExpiration = 60 * 24 * 365;
    public $defaultAccessGiven = '{"access":["all"]}';
    public $defaultConsumer = 'mobile';


    public static function tableName()
    {
        return 'access_token';
    }

    public static function generateAuthKey($user)
    {
        $accessToken = new AccessToken();
        $accessToken->user_id = $user->id;
        $accessToken->consumer = $user->consumer ?? $accessToken->defaultConsumer;
        $accessToken->access_given = $user->access_given ?? $accessToken->defaultAccessGiven;
        $accessToken->token = $user->auth_key;
        $accessToken->used_at = strtotime("now");
        $accessToken->expire_at = $accessToken->tokenExpiration + $accessToken->used_at;
        $accessToken->save();
    }

    public static function makeAllUserTokenExpiredByUserId($userId){
        AccessToken::updateAll(['expire_at' => strtotime("now")], ['user_id' => $userId]);
    }

    public function expireThisToken(){
        $this->expire_at = strtotime("now");
        return $this->save();
    }


    public function rules()
    {
        return [
            [['user_id', 'used_at', 'expire_at', 'created_at', 'updated_at'], 'integer'],
            [['token'], 'required'],
            [['access_given'], 'string'],
            [['consumer'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => 32],
            [['token'], 'unique'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'consumer' => 'Consumer',
            'token' => 'Token',
            'access_given' => 'Access Given',
            'used_at' => 'Used At',
            'expire_at' => 'Expire At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}