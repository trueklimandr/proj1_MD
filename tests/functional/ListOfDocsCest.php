<?php

use app\models\Doctors;

/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 11:31
 */

class ListOfDocsCest
{
    public function getListOfZeroDocs(\FunctionalTester $I)
    {
        $I->haveMultiple(Doctors::class, 5);
        /*$I->sendGET('/doctors');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse());
        $I->assertEquals(0, count($response));*/
    }

   /* public function getListOfFiveDocs(\FunctionalTester $I)
    {
        $I->haveMultiple(Doctors::class, 5);
        $I->sendGET('doctors');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse());
        $I->assertEquals(5, count($response));
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'firstname' => 'string',
            'lastname' => 'string',
            'spec' => 'string',
        ],
            '$.doctors[1]');
    }*/
}
