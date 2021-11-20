<?php

namespace Tests\Feature;

use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * コース一覧取得テスト
     *
     * @return void
     */
    public function testIndex()
    {
        CourseElq::factory()->count(5)->create();
        $response = $this->get('api/course/index');
        $response->assertJsonCount(5, 'courses');
    }

    /**
     * コース新規作成テスト
     *
     * @return void
     */
    public function testNew()
    {
        $data = [
            'name' => 'test course',
            'price' => 1000,
            'capacity' => 5,
            'location' => 'aaaaa',
            'description' => 'xxxxx',
        ];
        $response = $this->post('api/course/new', $data);
        $this->assertEquals('test course', $response['course']['name']);
    }

    /**
     * コース更新テスト
     *
     * @return void
     */
    public function testUpdate()
    {
        $courseElq = CourseElq::factory()->create();

        $data = [
            'id' => $courseElq->id,
            'name' => 'test course',
            'price' => $courseElq->price,
            'location' => $courseElq->location,
            'capacity' => $courseElq->capacity,
            'description' => $courseElq->description,
            'isFinished' => $courseElq->is_finished,
        ];
        $response = $this->post('api/course/update', $data);
        $courseElqUpdated = CourseElq::find($courseElq->id);
        $this->assertEquals($response['course']['name'], $courseElqUpdated->name);
    }
}
