<?php

namespace RsvForm\Infrastructure\Repositories;

use App\Models\CourseElq;
use Illuminate\Support\Collection;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\ICourseRepository;

class CourseRepository implements ICourseRepository
{
    /**
     * Get all Course entities.
     *
     * @return Course[]
     */
    public static function getAll(): Collection
    {
        $results = [];

        $courseElqCollection = CourseElq::query()
            ->where('is_deleted', false)
            ->get();

        return $courseElqCollection->map(function ($courseElq) {
            return Course::reconstruct(
                $courseElq->id,
                $courseElq->name,
                $courseElq->price,
                $courseElq->capacity,
                $courseElq->location,
                $courseElq->description,
                $courseElq->is_finished
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

        if (is_null($courseElq)) {
            return null;
        }

        return Course::reconstruct(
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
     * Persitst(insert or update) Course entity.
     *
     * @return Course
     */
    public static function persist(Course $course): Course
    {
        if (is_null($course->getId())) {
            $courseElq = new CourseElq();
        } else {
            $courseElq = CourseElq::find($course->getId());
        }

        $courseElq->name = $course->getName();
        $courseElq->price = $course->getPrice();
        $courseElq->capacity = $course->getCapacity();
        $courseElq->location = $course->getLocation();
        $courseElq->description = $course->getDescription();
        $courseElq->is_finished = $course->getIsFinished();

        $courseElq->save();

        return Course::reconstruct(
            $courseElq->id,
            $courseElq->name,
            $courseElq->price,
            $courseElq->capacity,
            $courseElq->location,
            $courseElq->description,
            $courseElq->is_finished,
        );
    }

    /**
     * Delete Course entity.
     *
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $courseElq = CourseElq::find($id);
        $courseElq->is_deleted = true;

        return $courseElq->save();
    }
}
