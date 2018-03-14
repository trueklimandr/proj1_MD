<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 13.03.18
 * Time: 10:03
 */

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class RestController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'except' => ['authorize'],
        ];
        return $behaviors;
    }
}