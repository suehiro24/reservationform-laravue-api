<?php

namespace Tests\Unit\Infrastructure\Repositories;

use App\Models\ApptSlotElq;
use App\Models\CourseElq;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Models\ApptSlot\TimeSlot;
use RsvForm\Domain\Models\Course\Course;
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

    public function testGetByCourse(): void
    {
        $courseElq = CourseElq::factory()->create();
        ApptSlotElq::factory()->for($courseElq)->count(5)->create();
        $course = Course::reconstruct(
            $courseElq->id,
            $courseElq->name,
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished
        );
        $apptSlots = $this->repository::getByCourse($course);

        $this->assertTrue(
            $apptSlots->every(function (ApptSlot $apptSlot) use ($courseElq) {
                return $apptSlot->getCourse()->getId() === $courseElq->id;
            })
        );
    }

    public function testGetAllDbEmpty(): void
    {
        $apptSlots = $this->repository::getAll();
        $this->assertEquals(0, count($apptSlots));
    }

    public function testFind(): void
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create([
            'name' => 'test appointment-slot',
        ]);
        $apptSlot = $this->repository::find($apptSlotElq->id);
        $this->assertEquals('test appointment-slot', $apptSlot->getName());
    }

    public function testFindNothing(): void
    {
        $apptSlot = $this->repository::find(99999);
        $this->assertTrue(is_null($apptSlot));
    }

    public function testInsert(): void
    {
        $courseElq = CourseElq::factory()->create();
        $course = Course::reconstruct(
            $courseElq->id,
            $courseElq->name,
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished
        );
        $start = new DateTime();
        $end = clone $start;
        $end = $end->add(new DateInterval('P10D'));
        $timeSlot = new TimeSlot(
            $start->format(DateTime::ATOM),
            $end->format(DateTime::ATOM),
        );
        $apptSlot = ApptSlot::create(
            $course,
            $timeSlot
        );

        $apptSlotCreated = $this->repository::persist($apptSlot);
        $apptSlotElqCreated = ApptSlotElq::find($apptSlotCreated->getId());
        $this->assertEquals($apptSlotElqCreated->name, $apptSlot->getName());
    }

    public function testUpdate(): void
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create();
        $course = Course::reconstruct(
            $courseElq->id,
            $courseElq->name,
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished
        );
        $apptSlot = ApptSlot::reconstruct(
            $apptSlotElq->id,
            $course,
            'appt-slot updated',
            $apptSlotElq->price,
            $apptSlotElq->capacity,
            $apptSlotElq->location,
            $apptSlotElq->note,
            $apptSlotElq->reservations,
            new TimeSlot($apptSlotElq->start, $apptSlotElq->end)
        );

        $apptSlotUpdated = $this->repository::persist($apptSlot);
        $apptSlotElqUpdated = ApptSlotElq::find($apptSlotElq->id);
        $this->assertEquals($apptSlotElqUpdated->name, $apptSlotUpdated->getName());
    }

    public function testDelete(): void
    {
        $courseElq = CourseElq::factory()->create();
        $apptSlotElq = ApptSlotElq::factory()->for($courseElq)->create();
        $isDeleted = $this->repository::delete($apptSlotElq->id);
        $apptSlotElqDeleted = ApptSlotElq::find($apptSlotElq->id);
        $this->assertTrue($isDeleted);
        $this->assertEmpty($apptSlotElqDeleted);
    }
}
