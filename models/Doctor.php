<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 11:45
 */
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Doctor for table doctor
 * @package app\models
 * @property int $doctorId
 * @property int $userId
 * @property string $specialization
 */

class Doctor extends ActiveRecord
{
    public function rules()
    {
        return [
            [['specialization'], 'safe'],
            ['email', 'email'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['userId' => 'userId']);
    }
}
