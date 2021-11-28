<?php

namespace RsvForm\Infrastructure\Repositories;

use App\Models\ApptSlotElq;
use Illuminate\Support\Collection;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\IApptSlotRepository;

class ApptSlotRepository implements IApptSlotRepository
{
    /**
     * Get all Appointment-Slot entities.
     *
     * @return ApptSlot[]
     */
    public static function getAll(): Collection
    {
        $apptSlotElqCollection = ApptSlotElq::query()->get();

        return $apptSlotElqCollection->map(function ($apptSlotElq) {
            $course = Course::reconstruct(
                $apptSlotElq->courseElq->id,
                $apptSlotElq->courseElq->name,
                $apptSlotElq->courseElq->price,
                $apptSlotElq->courseElq->capacity,
                $apptSlotElq->courseElq->location,
                $apptSlotElq->courseElq->description,
                $apptSlotElq->courseElq->is_finished
            );

            return ApptSlot::reconstruct(
                $apptSlotElq->id,
                $course,
                $apptSlotElq->name,
                $apptSlotElq->price,
                $apptSlotElq->capacity,
                $apptSlotElq->location,
                $apptSlotElq->note,
                $apptSlotElq->reservations,
                $apptSlotElq->start,
                $apptSlotElq->end,
            );
        });
    }
}
