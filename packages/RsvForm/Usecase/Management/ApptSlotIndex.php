<?php

namespace RsvForm\Usecase\Management;

use Illuminate\Support\Collection;
use RsvForm\Domain\Repositories\IApptSlotRepository;

class ApptSlotIndex
{
     /**
     * @var IApptSlotRepository
     */
    private $repository;

    public function __construct(IApptSlotRepository $repository)
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
