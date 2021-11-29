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
     * 予約枠新規作成テスト
     *
     * @return void
     */
    public function testNew()
    {
        $courseElq = CourseElq::factory()->create([
            'name' => 'test course'
        ]);

        $start = new DateTime();
        $end = clone $start;
        $end = $end->add(new DateInterval('P10D'));
        $data = [
            'courseId' => $courseElq->id,
            'start' => $start,
            'end' => $end,
        ];

        $response = $this->post('api/appt-slot/new', $data);
        $response->assertCreated();
        $this->assertEquals('test course', $response['apptSlot']['name']);
    }

    // /**
    //  * 予約枠更新テスト
    //  *
    //  * @return void
    //  */
    // public function testUpdate()
    // {
    //     $courseElq = CourseElq::factory()->create();

    //     $data = [
    //         'id' => $courseElq->id,
    //         'name' => 'test course',
    //         'price' => $courseElq->price,
    //         'location' => $courseElq->location,
    //         'capacity' => $courseElq->capacity,
    //         'description' => $courseElq->description,
    //         'isFinished' => $courseElq->is_finished,
    //     ];
    //     $response = $this->post('api/course/update', $data);
    //     $courseElqUpdated = CourseElq::find($courseElq->id);
    //     $response->assertOK();
    //     $this->assertEquals($response['course']['name'], $courseElqUpdated->name);
    // }

    // /**
    //  * 予約枠削除テスト
    //  *
    //  * @return void
    //  */
    // public function testDelete()
    // {
    //     $courseElq = CourseElq::factory()->create();
    //     $data = [
    //         'id' => $courseElq->id
    //     ];
    //     $response = $this->post('api/course/delete', $data);
    //     $courseElqDeleted = CourseElq::find($courseElq->id);
    //     $response->assertOk();
    //     $this->assertTrue($courseElqDeleted->is_deleted);
    // }
}
