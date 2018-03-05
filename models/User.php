<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 12:11
 */

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Doctor for table doctor
 * @package app\models\dbase
 * @property int $userId
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $type
 */
class User extends ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'firstName',
                    'lastName',
                    'specialization',
                    'email',
                    'password',
                    'type'
                ],
                'safe'
            ],
            ['email', 'email'],
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::class, ['userId' => 'userId']);
    }
}
