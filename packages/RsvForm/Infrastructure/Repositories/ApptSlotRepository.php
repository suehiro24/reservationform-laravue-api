<?php

namespace RsvForm\Infrastructure\Repositories;

use App\Models\ApptSlotElq;
use Exception;
use Illuminate\Support\Collection;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Models\ApptSlot\TimeSlot;
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
                new TimeSlot($apptSlotElq->start, $apptSlotElq->end)
            );
        });
    }

    /**
     * Get Appointment-Slot entities in spesific Course.
     *
     * @return ApptSlot[]
     */
    public static function getByCourse(Course $course)
    {
        $apptSlotElqCollection = ApptSlotElq::query()->where('course_id', $course->getId())->get();

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
                new TimeSlot($apptSlotElq->start, $apptSlotElq->end)
            );
        });
    }

    /**
     * Get specific Appointment-Slot entity.
     *
     * @return ApptSlot[]
     */
    public static function find(int $id): ?ApptSlot
    {
        $apptSlotElq = ApptSlotElq::query()
            ->with('courseElq')
            ->find($id);

        if (is_null($apptSlotElq)) {
            return null;
        }

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
            new TimeSlot($apptSlotElq->start, $apptSlotElq->end)
        );
    }

    /**
     * Persitst(insert or update) Appointment-Slot entity.
     *
     * @return ApptSlot
     */
    public static function persist(ApptSlot $apptSlot): ApptSlot
    {
        if (is_null($apptSlot->getId())) {
            $apptSlotElq = new ApptSlotElq();
        } else {
            $apptSlotElq = ApptSlotElq::find($apptSlot->getId());
        }

        if (isset($apptSlotElq->course_id)) {
            if ($apptSlotElq->course_id !== $apptSlot->getCourse()->getId()) {
                throw new Exception('コースIDの変更不可');
            }
        } else {
            $apptSlotElq->course_id = $apptSlot->getCourse()->getId();
        }
        $apptSlotElq->name = $apptSlot->getName();
        $apptSlotElq->price = $apptSlot->getPrice();
        $apptSlotElq->capacity = $apptSlot->getCapacity();
        $apptSlotElq->location = $apptSlot->getLocation();
        $apptSlotElq->note = $apptSlot->getNote();
        $apptSlotElq->reservations = $apptSlot->getReservations();
        $apptSlotElq->start = $apptSlot->getTimeSlot()->getStart();
        $apptSlotElq->end = $apptSlot->getTimeSlot()->getEnd();

        $apptSlotElq->save();

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
            new TimeSlot($apptSlotElq->start, $apptSlotElq->end)
        );
    }

    /**
     * Set Delete Flag to Appointment-Slot entity.
     *
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $apptSlotElq = ApptSlotElq::find($id);
        if (is_null($apptSlotElq)) {
            // TODO: log::warn(予約枠削除済み)
            return true;
        }
        return $apptSlotElq->delete();
    }
}
