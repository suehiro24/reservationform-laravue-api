<?php

namespace RsvForm\Usecase\Management;

use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\ICourseRepository;

class CourseCreate
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
        $course = Course::create(
            $posts['name'],
            $posts['price'],
            $posts['capacity'],
            $posts['location'],
            $posts['description'],
        );

        return $this->repository->persist($course);
    }
}
