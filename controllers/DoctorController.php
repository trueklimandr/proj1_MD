<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 14:21
 */
namespace app\controllers;

use app\models\Doctor;

class DoctorController extends RestController
{
    public $modelClass = Doctor::class;

    public function actions()
    {
        $actions = parent::actions();
        // deactivate actions
        unset(
            $actions['view'],
            $actions['create'],
            $actions['update'],
            $actions['delete']
        );

        return $actions;
    }
}
