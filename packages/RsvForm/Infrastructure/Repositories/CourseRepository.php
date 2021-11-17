<?php

namespace RsvForm\Infrastructure\Repositories;

use App\Models\CourseElq;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\ICourseRepository;

class CourseRepository implements ICourseRepository
{
    /**
     * Get all Course entities.
     *
     * @return Course[]
     */
    public static function getAll(): array
    {
        $results = [];

        $courseElqCollection = CourseElq::query()
            ->where('is_deleted', false)
            ->get();

        return $courseElqCollection->map(function ($courseElq) {
            return Course::reconscruct(
                $courseElq->id,
                $courseElq->name,
                $courseElq->price,
                $courseElq->capacity,
                $courseElq->location,
                $courseElq->description,
                $courseElq->is_finished,
                $courseElq->is_deleted
            );
        });

        return $results;
    }

    /**
     * Find specific Course entity.
     *
     * @return Course|null
     */
    public static function find(int $id): ?Course
    {
        $courseElq = CourseElq::query()
            ->where('is_deleted', false)
            ->where('id', $id)
            ->first();

        if(is_null($courseElq)) return null;

        return Course::reconscruct(
            $courseElq->id,
            $courseElq->name,
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished,
            $courseElq->is_deleted
        );
    }

    /**
     * Persitst(update or save) Course entity.
     *
     * @return Course
     */
    public static function persist(Course $course): Course
    {
        $courseElq = new CourseElq();

        $courseElq->id = $course->getId();
        $courseElq->name = $course->getName();
        $courseElq->price = $course->getPrice();
        $courseElq->capacity = $course->getCapacity();
        $courseElq->location = $course->getLocation();
        $courseElq->description = $course->getDescription();
        $courseElq->is_finished = $course->getIsFinished();
        $courseElq->is_deleted = $course->getIsDeleted();

        $courseElq->save();

        return Course::reconscruct(
            $courseElq->id,
            $courseElq->name,
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished,
            $courseElq->is_deleted
        );
    }
}
