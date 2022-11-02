<?php

namespace RsvForm\Usecase\Management;

use Illuminate\Support\Collection;
use RsvForm\Domain\Repositories\ICourseRepository;

class CourseIndex
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
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return $this->repository->getAll();
    }
}
