<?php

namespace RsvForm\Domain\Repositories;

use Illuminate\Support\Collection;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;
use RsvForm\Domain\Models\Course\Course;

interface IApptSlotRepository
{
    /**
     * Get all Appointment-Slot entities.
     *
     * @return ApptSlot[]|Collection
     */
    public static function getAll();

    /**
     * Get Appointment-Slot entities in spesific Course.
     *
     * @return  ApptSlot[]|Collection
     */
    public static function getByCourse(Course $course);

    /**
     * Find specific Appointment-Slot entity.
     *
     * @return ApptSlot|null
     */
    public static function find(int $id): ?ApptSlot;

    /**
     * Persitst(insert or update) Appointment-Slot entity.
     *
     * @return ApptSlot
     */
    public static function persist(ApptSlot $apptSlot): ApptSlot;

    /**
     * Set Delete Flag to Appointment-Slot entity.
     *
     * @return bool
     */
    public static function delete(int $id): bool;
}
