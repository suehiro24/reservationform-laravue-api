<?php

namespace RsvForm\Usecase\Management;

use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\ICourseRepository;

class CourseUpdate
{
    /**
     * @var ICourseRepository
     */
    private $repository;

    public function __construct(ICourseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Course
     */
    public function __invoke($posts): Course
    {
        $course = Course::reconstruct(
            $posts['id'],
            $posts['name'],
            $posts['price'],
            $posts['capacity'],
            $posts['location'],
            $posts['description'],
            $posts['isFinished'],
        );
        return $this->repository->persist($course);
    }
}
