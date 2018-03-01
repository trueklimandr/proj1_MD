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
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $spec
 */

class Doctor extends ActiveRecord
{
}
