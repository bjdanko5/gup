<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name ='test';
    public $email='test@test.ru';

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}