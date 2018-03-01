<?php

use app\models\Doctor;

/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 11:31
 */

class DoctorIndexActionCest
{
    public function testGettingListOfZeroDocs(\FunctionalTester $I)
    {
        $I->sendGET('doctor');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse());
        $I->assertEquals(0, count($response));
    }

    public function testGettingListOfFiveDocs(\FunctionalTester $I)
    {
        $I->haveMultiple(Doctor::class, 5);
        $I->sendGET('doctor');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse());
        $I->assertEquals(5, count($response));
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'firstname' => 'string',
            'lastname' => 'string',
            'specialization' => 'string',
        ]);
    }
}
