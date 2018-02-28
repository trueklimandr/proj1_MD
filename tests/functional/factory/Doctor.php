<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 27.02.18
 * Time: 17:31
 */
use League\FactoryMuffin\Faker\Facade as Faker;

$fm->define('Doctor')->setDefinitions([
    'firstname' => Faker::firstName(),  // Set the firstname attribute to a random male first name
    'lastname'  => Faker::lastName(),   //
    'foo'    => Faker::word(),          // Set the foo attribute to a random word
    'name'   => Faker::firstNameMale(), // Set the name attribute to a random male first name
    'email'  => Faker::email(),         // Set the email attribute to a random email address
    'body'   => Faker::text(),          // Set the body attribute to a random string of text
    'slogan' => Faker::sentence(),      // Set the slogan attribute to a random sentence
]);