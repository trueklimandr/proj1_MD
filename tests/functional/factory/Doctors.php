<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 27.02.18
 * Time: 17:31
 */
use League\FactoryMuffin\Faker\Facade as Faker;
use app\models\Doctors;

$fm->define(Doctors::class)->setDefinitions([
    'id'        => Faker::randomNumber(),   // Set id
    'firstname' => Faker::firstName(),      // Set the firstname attribute to a random first name
    'lastname'  => Faker::lastName(),       // Set the lastname attribute to a random last name
    'spec'      => Faker::jobTitle(),       // Set the spec attribute to a random job
]);
