<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 13:29
 */
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\User;

class UserController extends ActiveController
{
    public $modelClass = User::class;
}
