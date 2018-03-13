<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 12:01
 */

use app\models\User;
use app\models\AccessToken;

class UserAddActionCest
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

    public function testAddSameEmailUser(\FunctionalTester $I)
    {
        $I->sendPOST('users', [
            'firstName' => 'Andrey',
            'lastName'  => 'Pupkov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-marol',
            'type' => 'user',
            ]);
        $I->seeResponseCodeIs(201);
        $I->sendPOST('users', [
            'firstName' => 'Fedor',
            'lastName'  => 'Zubkov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->dontSeeResponseCodeIs(201);
    }

    public function testAddWrongEmailUser(\FunctionalTester $I)
    {
        $I->sendPOST('users', [
            'firstName' => 'Fedor',
            'lastName'  => 'Zubkov',
            'email' => 'zub123mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->dontSeeResponseCodeIs(201);
    }

    public function testAddEmptyPasswordUser(\FunctionalTester $I)
    {
        $I->sendPOST('users', [
            'firstName' => 'Andrey',
            'lastName'  => 'Pupkov',
            'email' => 'a.pupkov@mail.ru',
            'password' => '',
            'type' => 'user',
        ]);
        $I->dontSeeResponseCodeIs(201);
    }

    public function testAddAnotherUser(\FunctionalTester $I)
    {
        $I->sendPOST('users', [
            'firstName' => 'Dmitry',
            'lastName'  => 'Kozlov',
            'email' => 'd.kozlov@mail.ru',
            'password' => 'parol-karol',
            'type' => 'user',
        ]);
        $I->seeResponseCodeIs(201);
        $I->sendPOST('users', [
            'firstName' => 'Ivan',
            'lastName'  => 'Korolev',
            'email' => 'i.korolev@mail.ru',
            'password' => 'K@r0l',
            'type' => 'user',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
    }
}
