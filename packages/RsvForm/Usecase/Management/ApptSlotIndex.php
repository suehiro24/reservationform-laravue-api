<?php

namespace RsvForm\Usecase\Management;

use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Repositories\IApptSlotRepository;
use RsvForm\Domain\Repositories\ICourseRepository;

class ApptSlotIndex
{
     /**
     * @var IApptSlotRepository
     */
    private $apptSlotRepository;

     /**
     * @var ICourseRepository
     */
    private $courseRepository;

    public function __construct(IApptSlotRepository $apptSlotRepository, ICourseRepository $courseRepository)
    {
        $this->apptSlotRepository = $apptSlotRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param int|null $courseId
     * @return ApptSlot[]|Collection
     */
    public function __invoke(?int $courseId = null)
    {

        if (is_null($courseId)) {
            return $this->apptSlotRepository::getAll();
        } else {
            $course = $this->courseRepository::find($courseId);
            return $this->apptSlotRepository::getByCourse($course);
        }
    }
}
