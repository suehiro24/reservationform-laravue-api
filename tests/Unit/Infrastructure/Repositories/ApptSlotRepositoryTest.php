<?php

namespace Tests\Unit\Infrastructure\Repositories;

use App\Models\ApptSlotElq;
use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RsvForm\Domain\Repositories\IApptSlotRepository;
use Tests\TestCase;

class ApptSlotRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    /**
     * @var IApptSlotRepository
     */
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app(IApptSlotRepository::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testGetAll(): void
    {
        $courseElq = CourseElq::factory()->create();
        ApptSlotElq::factory()->for($courseElq)->count(5)->create();
        $apptSlots = $this->repository::getAll();
        $this->assertEquals(5, count($apptSlots));
    }

    // public function testGetAllDbEmpty(): void
    // {
    //     $apptSlots = $this->repository::getAll();
    //     $this->assertEquals(0, count($apptSlots));
    // }

    // public function testFind(): void
    // {
    //     $apptSlotElq = ApptSlotElq::factory()->create([
    //         'name' => 'test appt-slot',
    //     ]);
    //     $apptSlot = $this->repository::find($apptSlotElq->id);
    //     $this->assertEquals('test appt-slot', $apptSlot->getName());
    // }

    // public function testInsert(): void
    // {
    //     $course = Course::create('name', 100, 10, 'location', 'description', false);
    //     $courseCreated = $this->repository::persist($course);
    //     $courseElqCreated = ApptSlotElq::find($courseCreated->getId());
    //     $this->assertEquals($courseElqCreated->name, $course->getName());
    // }

    // public function testUpdate(): void
    // {
    //     $courseElq = ApptSlotElq::factory()->create();
    //     $course = Course::reconstruct(
    //         $courseElq->id,
    //         'name updated',
    //         $courseElq->price,
    //         $courseElq->capacity,
    //         $courseElq->location,
    //         $courseElq->description,
    //         $courseElq->is_finished,
    //     );
    //     $courseUpdated = $this->repository::persist($course);
    //     $courseElqUpdated = ApptSlotElq::find($courseElq->id);
    //     $this->assertEquals($courseElqUpdated->name, $courseUpdated->getName());
    // }

    // public function testDelete(): void
    // {
    //     $courseElq = ApptSlotElq::factory()->create();
    //     $isDeleted = $this->repository::delete($courseElq->id);
    //     $courseElqDeleted = ApptSlotElq::query()
    //         ->where('is_deleted', true)
    //         ->where('id', $courseElq->id)
    //         ->get();
    //     $this->assertTrue($isDeleted);
    //     $this->assertNotEmpty($courseElqDeleted);
    // }
}
