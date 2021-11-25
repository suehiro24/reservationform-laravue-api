<?php

namespace Tests\Unit\Infrastructure\Repositories;

use App\Models\ApptSlotElq;
use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApptSlotEsqTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testGetAll(): void
    {
        $courseElq = CourseElq::factory()->create();
        ApptSlotElq::factory()->for($courseElq)->count(5)->create();
        $apptSlotElqAll = ApptSlotElq::get();
        $this->assertEquals(5, count($apptSlotElqAll));
    }
}
