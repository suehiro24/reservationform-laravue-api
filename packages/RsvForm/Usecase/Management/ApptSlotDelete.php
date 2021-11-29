<?php

namespace RsvForm\Usecase\Management;

use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Repositories\IApptSlotRepository;

class ApptSlotDelete
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
     * @return ApptSlot
     */
    public function __invoke($posts): bool
    {
        return $this->repository->delete($posts['id']);
    }
}
