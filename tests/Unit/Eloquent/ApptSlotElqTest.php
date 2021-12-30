<?php

namespace Tests\Unit\Eloquent;

use App\Models\ApptSlotElq;
use App\Models\CourseElq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApptSlotElqTest extends TestCase
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
