<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 06.03.18
 * Time: 9:53
 */

use app\models\User;

class UserAuthorizeActionCest
{
    private $transaction;

    public function _before()
    {
        $this->transaction = Yii::$app->db->beginTransaction();
    }

    public function _after()
    {
        $this->transaction->rollback();
    }

    public function testAuthorize(\FunctionalTester $I)
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
        $I->seeResponseMatchesJsonType([
            'token' => 'string',
            'userId' => 'integer'
        ]);
    }

    public function testAuthorizeByWrongUser(\FunctionalTester $I)
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

    public function testAuthorizeWithWrongPassword(\FunctionalTester $I)
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
