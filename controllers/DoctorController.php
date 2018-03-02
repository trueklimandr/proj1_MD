<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 14:21
 */
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Doctor;

class DoctorController extends ActiveController
{
    public $modelClass = Doctor::class;
}
