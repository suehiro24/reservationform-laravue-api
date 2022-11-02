<?php

namespace RsvForm\Usecase\Form;

use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Repositories\IApptSlotRepository;

class AcceptReservation
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
    public function __invoke($posts): ApptSlot
    {
        $apptSlot = $this->repository::find($posts['id']);
        unset($posts['id']);
        $apptSlotReserved = ApptSlot::reserve($apptSlot, $posts);

        return $this->repository->persist($apptSlotReserved);
    }
}
