<?php

namespace Tests\Unit\Infrastructure\Repositories;

use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\ICourseRepository;
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

        $this->repository = app(ICourseRepository::class);
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

    public function testGetAllDbEmpty(): void
    {
        $course = $this->repository::getAll();
        $this->assertEquals(0, count($course));
    }

    public function testFind(): void
    {
        $courseElq = CourseElq::factory()->create([
            'name' => 'test course',
        ]);
        $course = $this->repository::find($courseElq->id);
        $this->assertEquals('test course', $course->getName());
    }

    public function testFindNothing(): void
    {
        $course = $this->repository::find(99999);
        $this->assertTrue(is_null($course));
    }

    public function testInsert(): void
    {
        $course = Course::create('name', 100, 10, 'location', 'description', false);
        $courseCreated = $this->repository::persist($course);
        $courseElqCreated = CourseElq::find($courseCreated->getId());
        $this->assertEquals($courseElqCreated->name, $course->getName());
    }

    public function testUpdate(): void
    {
        $courseElq = CourseElq::factory()->create();
        $course = Course::reconstruct(
            $courseElq->id,
            'name updated',
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished,
        );
        $courseUpdated = $this->repository::persist($course);
        $courseElqUpdated = CourseElq::find($courseElq->id);
        $this->assertEquals($courseElqUpdated->name, $courseUpdated->getName());
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
