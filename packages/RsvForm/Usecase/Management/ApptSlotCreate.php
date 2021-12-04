<?php

namespace RsvForm\Usecase\Management;

use Carbon\Carbon;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Repositories\IApptSlotRepository;
use RsvForm\Domain\Repositories\ICourseRepository;

class ApptSlotCreate
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
        $course = $this->courseRepository::find($posts["courseId"]);
        $apptSlot = ApptSlot::create(
            $course,
            new Carbon($posts['start']),
            new Carbon($posts['end'])
        );
        return $this->apptSlotRepository->persist($apptSlot);
    }
}
