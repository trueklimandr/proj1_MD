<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 28.02.18
 * Time: 11:31
 */

use app\models\Doctor;

class DoctorIndexActionCest
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

    public function testGettingListOfZeroDocs(\FunctionalTester $I)
    {
        $I->sendGET('doctors');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse());
        $I->assertEquals(0, count($response));
    }

    public function testGettingListOfFiveDocs(\FunctionalTester $I)
    {
        $I->haveMultiple(Doctor::class, 5);
        $I->sendGET('doctors');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse());
        $I->assertEquals(5, count($response));
        sleep(7);
        $I->seeResponseMatchesJsonType([
            'doctorId' => 'integer',
            'specialization' => 'string',
        ]);
    }
}
