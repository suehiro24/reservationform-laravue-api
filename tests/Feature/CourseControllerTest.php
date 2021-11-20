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
}
