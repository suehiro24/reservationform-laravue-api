<?php

namespace Tests\Unit\Infrastructure\Repositories;

use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use RsvForm\Infrastructure\Repositories\CourseRepository;
use Tests\TestCase;

class CourseRepositoryTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * @var ICourseRepository
     */
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app(CourseRepository::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testFind(): void
    {
        // CourseElq::factory()->create();

        $course = $this->repository::find(1);
        // テスト結果の検証
        $this->assertEquals('test course', $course->getName());
    }
}
