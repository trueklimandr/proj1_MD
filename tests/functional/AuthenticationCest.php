<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 13.03.18
 * Time: 11:10
 */

use app\models\AccessToken;

class AuthenticationCest
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

    // unauthorized user can't see list of doctors
    public function testGettingListOfDocsByUnknownUser(\FunctionalTester $I)
    {
        $I->sendGET('doctors');
        $I->seeResponseCodeIs(401);
    }

    // authorized user can see list of doctors
    public function testGettingListOfDocsByUser(\FunctionalTester $I)
    {
        $I->have(AccessToken::class);
        $accessToken = AccessToken::find()->one();
        $I->amHttpAuthenticated($accessToken['token'], '');
        $I->sendGET('doctors');
        $I->seeResponseCodeIs(200);
    }

    // anyone can register
    public function testAddNewUser(\FunctionalTester $I)
    {
        $I->sendPOST('users', [
            'firstName' => 'Dmitry',
            'lastName'  => 'Kozlov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
    }
}
