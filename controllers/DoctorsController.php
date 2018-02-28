<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 14:21
 */
namespace app\controllers;

use yii\rest\ActiveController;

class DoctorsController extends ActiveController
{
    public $modelClass = 'app\models\Doctors';
}
