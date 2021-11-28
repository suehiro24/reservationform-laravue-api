<?php

namespace RsvForm\Domain\Repositories;

use Illuminate\Support\Collection;
use RsvForm\Domain\Models\ApptSlot\ApptSlot;

interface IApptSlotRepository
{
    /**
     * Get all Appointment-Slot entities.
     *
     * @return ApptSlot[]
     */
    public static function getAll(): Collection;

    // /**
    //  * Find specific Appointment-Slot entity.
    //  *
    //  * @return ApptSlot|null
    //  */
    // public static function find(int $id): ?ApptSlot;

    // /**
    //  * Persitst(insert or update) Appointment-Slot entity.
    //  *
    //  * @return ApptSlot
    //  */
    // public static function persist(ApptSlot $course): ApptSlot;

    // /**
    //  * Set Delete Flag to Appointment-Slot entity.
    //  *
    //  * @return bool
    //  */
    // public static function delete(int $id): bool;
}
