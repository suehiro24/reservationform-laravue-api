<?php

namespace RsvForm\Presentation;

use Illuminate\Support\Collection;
use RsvForm\Domain\Models\Course\Course;

/**
 * JsonResponseのためのシリアライザ
 */
class CourseJsonSerializer
{
    /**
     * @param  Course  $course
     * @return array
     */
    public function serialize(Course $course): array
    {
        return [
            'id' => $course->getId(),
            'name' => $course->getName(),
            'price' => $course->getPrice(),
            'capacity' => $course->getCapacity(),
            'location' => $course->getLocation(),
            'description' => $course->getDescription(),
            'isFinished' => $course->getIsFinished(),
        ];
    }

    /**
     * @param  Collection|Course[]  $courses
     * @return array
     */
    public function serializeCollection(Collection $courses): array
    {
        return array_map(
            function (Course $course) {
                return $this->serialize($course);
            },
            $courses->all()
        );
    }
}
