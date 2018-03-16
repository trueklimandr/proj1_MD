<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 14.03.18
 * Time: 16:14
 */

namespace app\tests\functional;

use app\models\TimeSlot;
use app\tests\functional\baseCest\BaseFunctionalCest;
use app\models\AccessToken;
use app\models\Doctor;

class DoctorAddTimeSlotActionCest extends BaseFunctionalCest
{
    public function testAddValidTimeSlot(\FunctionalTester $I)
    {
        $doctor = $I->have(Doctor::class);
        $accessToken = $I->have(AccessToken::class, ['userId' => $doctor->userId]);
        $I->amHttpAuthenticated($accessToken->token, '');
        $I->sendPOST('time-slots', [
            'doctorId' => $doctor->doctorId,
            'date' => '2018-03-18',
            'start' => '08:00:00',
            'end' => '15:00:00'
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesXPath('//id');
        $response = json_decode($I->grabResponse());
        $I->seeRecord('app\models\TimeSlot', [
            'id' => $response->id,
            'doctorId' => $response->doctorId,
            'date' => $response->date,
            'start' => $response->start,
            'end' => $response->end,
        ]);
    }

    public function testAddIncorrectDueToIntersectionTimeSlot(\FunctionalTester $I)
    {
        $doctor = $I->have(Doctor::class);
        $accessToken = $I->have(AccessToken::class, ['userId' => $doctor->userId]);
        $I->amHttpAuthenticated($accessToken->token, '');
        $timeSlot = $I->have(TimeSlot::class, [
            'doctorId' =>$doctor->doctorId,
            'start' => '08:30:00',
            'end' => '12:30:00'
        ]);
        $I->sendPOST('time-slots', [
            'doctorId' => $timeSlot->doctorId,
            'date' => $timeSlot->date,
            'start' => '10:25:00',
            'end' => '15:00:00'
        ]);
        $I->seeResponseCodeIs(422);
    }

    public function testAddIncorrectPeriodOfTimeSlot(\FunctionalTester $I)
    {
        $doctor = $I->have(Doctor::class);
        $accessToken = $I->have(AccessToken::class, ['userId' => $doctor->userId]);
        $I->amHttpAuthenticated($accessToken->token, '');
        $I->sendPOST('time-slots', [
            'doctorId' => $doctor->doctorId,
            'date' => '2018-03-18',
            'start' => '12:00:00',
            'end' => '09:00:00'
        ]);
        $I->seeResponseCodeIs(422);
    }

    public function testAddValidTimeSlotByOtherDoctor(\FunctionalTester $I)
    {
        $doctor2 = $I->have(Doctor::class);
        $doctor = $I->have(Doctor::class);
        $accessToken = $I->have(AccessToken::class, ['userId' => $doctor->userId]);
        $I->amHttpAuthenticated($accessToken->token, '');
        $I->sendPOST('time-slots', [
            'doctorId' => $doctor2->doctorId,
            'date' => '2018-03-18',
            'start' => '08:00:00',
            'end' => '15:00:00'
        ]);
        $I->seeResponseCodeIs(422);
    }
}
