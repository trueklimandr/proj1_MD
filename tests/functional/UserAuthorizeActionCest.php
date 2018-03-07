<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 06.03.18
 * Time: 9:53
 */

use app\models\AccessToken;
use app\models\User;

class UserAuthorizeActionCest
{
    public function _before()
    {
        AccessToken::deleteAll();
        User::deleteAll();
    }

    public function testGettingToken(\FunctionalTester $I)
    {
        $I->have(User::class, [
            'firstName' => 'Dmitry',
            'lastName'  => 'Kozlov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->sendPOST('users/authorize', [
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol'
            ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
    }

    public function testGettingTokenByWrongUser(\FunctionalTester $I)
    {
        $I->have(User::class, [
            'firstName' => 'Dmitry',
            'lastName'  => 'Kozlov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->sendPOST('users/authorize', [
            'email' => 'd_kozlov@mail.ru',
            'password' => 'parol-karol'
        ]);
        $I->seeResponseCodeIs(401);
    }

    public function testGettingTokenWithWrongPassword(\FunctionalTester $I)
    {
        $I->have(User::class, [
            'firstName' => 'Dmitry',
            'lastName'  => 'Kozlov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->sendPOST('users/authorize', [
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol123'
        ]);
        $I->seeResponseCodeIs(401);
    }
}
