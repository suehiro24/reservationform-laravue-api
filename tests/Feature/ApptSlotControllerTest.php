<?php

namespace Tests\Feature;

use App\Models\ApptSlotElq;
use App\Models\CourseElq;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApptSlotControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * 予約枠一覧取得テスト
     *
     * @return void
     */
    public function testIndex()
    {
        $courseElq = CourseElq::factory()->create();
        ApptSlotElq::factory()->for($courseElq)->count(5)->create();
        $response = $this->get('api/appt-slot/index');
        $response->assertOK();
        $response->assertJsonCount(5, 'apptSlots');
    }

    /**
     * 予約枠一覧取得テスト. コース絞り込みあり
     *
     * @return void
     */
    public function testIndexFilteredCourse()
    {
        $courseElq = CourseElq::factory()->create();
        ApptSlotElq::factory()->for($courseElq)->count(5)->create();
        $response = $this->get('api/appt-slot/index/'.$courseElq->id);
        $response->assertOK();
        $response->assertJsonCount(5, 'apptSlots');

        $slotsNotInTargetCourse = array_filter($response['apptSlots'], function ($apptSlot) use ($courseElq) {
            $apptSlot['id'] !== $courseElq->id;
        });
        $this->assertEquals(0, count($slotsNotInTargetCourse));
    }

    /**
     * 予約枠新規作成テスト
     *
     * @return void
     */
    public function testNew()
    {
        $courseElq = CourseElq::factory()->create([
            'name' => 'test course',
        ]);

        $start = new DateTime();
        $end = clone $start;
        $end = $end->add(new DateInterval('P10D'));
        $data = [
            'courseId' => $courseElq->id,
            'start' => $start->format(DateTime::ATOM),
            'end' => $end->format(DateTime::ATOM),
        ];

        $response = $this->post('api/appt-slot/new', $data);
        $response->assertCreated();
        $this->assertEquals('test course', $response['apptSlot']['name']);
    }

    /**
     * 予約枠更新テスト
     *
     * @return void
     */
    public function testUpdate()
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create();

        $data = [
            'id' => $apptSlotElq->id,
            'courseId' => $apptSlotElq->courseElq->id,
            'name' => 'updated appt-slot',
            'price' => $apptSlotElq->price,
            'location' => $apptSlotElq->location,
            'capacity' => $apptSlotElq->capacity,
            'note' => $apptSlotElq->note,
            'reservations' => $apptSlotElq->reservations,
            'start' => $apptSlotElq->start->format(DateTime::ATOM),
            'end' => $apptSlotElq->end->format(DateTime::ATOM),
        ];
        $response = $this->post('api/appt-slot/update', $data);
        $apptSlotElqUpdated = ApptSlotElq::find($apptSlotElq->id);
        $response->assertOK();
        $this->assertEquals($response['apptSlot']['name'], $apptSlotElqUpdated->name);
    }

    /**
     * 予約枠削除テスト
     *
     * @return void
     */
    public function testDelete()
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create();
        $data = [
            'id' => $apptSlotElq->id,
        ];
        $response = $this->post('api/appt-slot/delete', $data);
        $apptSlotElqDeleted = ApptSlotElq::find($apptSlotElq->id);
        $response->assertOk();
        $this->assertEmpty($apptSlotElqDeleted);
    }

    /**
     * 予約受付テスト
     *
     * @return void
     */
    public function testAcceptReservation()
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create();
        $data = [
            'id' => $apptSlotElq->id,
            '氏名' => 'test name',
            'メールアドレス' => 'test e-mail address',
            '備考' => 'test note',
        ];
        $response = $this->post('api/appt-slot/reserve', $data);
        $apptSlotElqReserved = ApptSlotElq::find($apptSlotElq->id);
        $response->assertOk();
        $this->assertEquals(($apptSlotElq->reservations + 1), $apptSlotElqReserved->reservations);
        $this->assertEquals(($apptSlotElq->reservations + 1), $response['apptSlot']['reservations']);
    }

    public function testReservationIsFull()
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create([
            'capacity' => 1,
            'reservations' => 0,
        ]);
        $data = [
            'id' => $apptSlotElq->id,
            '氏名' => 'test name',
            'メールアドレス' => 'test e-mail address',
            '備考' => 'test note',
        ];
        $response = $this->post('api/appt-slot/reserve', $data);
        $apptSlotElqReserved = ApptSlotElq::find($apptSlotElq->id);
        $response->assertOk();
        $this->assertEquals($apptSlotElqReserved->reservations, 1);
        $this->assertEquals($apptSlotElqReserved->is_full, true);
    }
}
