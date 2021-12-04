<?php

namespace RsvForm\Usecase\Management;

use Carbon\Carbon;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Repositories\IApptSlotRepository;
use RsvForm\Domain\Repositories\ICourseRepository;

class ApptSlotUpdate
{
    /**
     * @var ICourseRepository
     */
    private $courseRepository;

    /**
     * @var IApptSlotRepository
     */
    private $apptSlotRepository;

    public function __construct(
        ICourseRepository $courseRepository,
        IApptSlotRepository $apptSlotRepository
    )
    {
        $this->courseRepository = $courseRepository;
        $this->apptSlotRepository = $apptSlotRepository;
    }

    /**
     * @return ApptSlot
     */
    public function __invoke($posts): ApptSlot
    {
        $course = $this->courseRepository::find($posts['courseId']);
        $apptSlot = ApptSlot::reconstruct(
            $posts['id'],
            $course,
            $posts['name'],
            $posts['price'],
            $posts['capacity'],
            $posts['location'],
            $posts['note'],
            $posts['reservations'],
            new Carbon($posts['start']),
            new Carbon($posts['end'])
        );
        return $this->apptSlotRepository->persist($apptSlot);
    }
}
