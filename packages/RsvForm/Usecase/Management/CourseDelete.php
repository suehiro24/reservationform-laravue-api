<?php

namespace RsvForm\Usecase\Management;

use phpDocumentor\Reflection\Types\Boolean;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Domain\Repositories\ICourseRepository;

class CourseDelete
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
    public function __invoke($posts): bool
    {
        return $this->repository->delete($posts['id']);
    }
}
