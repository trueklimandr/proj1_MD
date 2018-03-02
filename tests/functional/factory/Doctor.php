<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 27.02.18
 * Time: 17:31
 */
use League\FactoryMuffin\Faker\Facade as Faker;
use app\models\Doctor;

$fm->define(Doctor::class)->setDefinitions([
    'firstName' => Faker::firstName(),      // Set the firstname attribute to a random first name
    'lastName'  => Faker::lastName(),       // Set the lastname attribute to a random last name
    'specialization' => Faker::jobTitle(),       // Set the spec attribute to a random job
]);
