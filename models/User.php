<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 12:11
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii;

/**
 * Class Doctor for table doctor
 * @package app\models
 * @property int $userId
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $type
 */
class User extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return true;
    }

    public function rules()
    {
        return [
            [
                [
                    'firstName',
                    'lastName',
                    'email',
                    'password',
                    'type'
                ],
                'safe'
            ],
            [
                [
                    'firstName',
                    'lastName',
                    'email',
                    'password',
                    'type'
                ],
                'required'
            ],
            ['type', 'in', 'range' => ['user', 'doctor']],
            ['email', 'email'],
            ['email', 'unique']
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::class, ['userId' => 'userId']);
    }

    public function getAccessToken()
    {
        return $this->hasOne(AccessToken::class, ['userId' => 'userId']);
    }
}
