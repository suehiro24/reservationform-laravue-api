<?php

namespace Tests\Feature;

use App\Models\ApptSlotElq;
use App\Models\CourseElq;
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
        var_dump($response['apptSlots']);
    }

    // /**
    //  * 予約枠新規作成テスト
    //  *
    //  * @return void
    //  */
    // public function testNew()
    // {
    //     $data = [
    //         'name' => 'test course',
    //         'price' => 1000,
    //         'capacity' => 5,
    //         'location' => 'aaaaa',
    //         'description' => 'xxxxx',
    //     ];
    //     $response = $this->post('api/course/new', $data);
    //     $response->assertCreated();
    //     $this->assertEquals('test course', $response['course']['name']);
    // }

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
