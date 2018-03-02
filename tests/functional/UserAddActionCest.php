<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 12:01
 */

class UserAddActionCest
{
    public function testAddNewUser(\FunctionalTester $I)
    {
        $I->sendPOST('users', [
            'firstName' => 'Dmitry',
            'lastName'  => 'Kozlov',
            'specialization' => '',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
            ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
    }
}
