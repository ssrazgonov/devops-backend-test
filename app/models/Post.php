<?php

namespace app\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord
{ 
    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'body'], 'string']
        ];
    }
}