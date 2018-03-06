<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 27.02.18
 * Time: 17:31
 */
use League\FactoryMuffin\Faker\Facade as Faker;
use app\models\Doctor;
use app\models\User;

$fm->define(Doctor::class)->setDefinitions([
    'userId' => function (Doctor $model) use ($fm) {
        $user = $fm->create(User::class, ['type' => 'doctor']);
        return $user->userId;
    },      // Set the firstname attribute to a random first name
    'specialization' => Faker::jobTitle(),  // Set the spec attribute to a random job
]);
