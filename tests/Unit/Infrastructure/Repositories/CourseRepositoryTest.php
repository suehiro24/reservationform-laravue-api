<?php

namespace Tests\Unit\Infrastructure\Repositories;

use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Infrastructure\Repositories\CourseRepository;
use Tests\TestCase;

class CourseRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

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

    public function testGetAll(): void
    {
        CourseElq::factory()->count(5)->create();
        $course = $this->repository::getAll();
        $this->assertEquals(5, count($course));
    }

    public function testFind(): void
    {
        $courseElq = CourseElq::factory()->create([
            'name' => 'test course',
        ]);
        $course = $this->repository::find($courseElq->id);
        $this->assertEquals('test course', $course->getName());
    }

    public function testPersist(): void
    {
        $course = Course::create('name', 100, 10, 'location', 'description', false);
        $course = $this->repository::persist($course);
        $this->assertEquals('name', $course->getName());
    }

    public function testDelete(): void
    {
        $courseElq = CourseElq::factory()->create();
        $isDeleted = $this->repository::delete($courseElq->id);
        $courseElqDeleted = CourseElq::query()
            ->where('is_deleted', true)
            ->where('id', $courseElq->id)
            ->get();
        $this->assertTrue($isDeleted);
        $this->assertNotEmpty($courseElqDeleted);
    }
}
