<?php

namespace RsvForm\Domain\Repositories;

use RsvForm\Domain\Models\Course\Course;

interface ICourseRepository
{
    /**
     * Get all Course entities.
     *
     * @return Course[]
     */
    public static function getAll(): array;

    /**
     * Find specific Course entity.
     *
     * @return Course|null
     */
    public static function find(int $id): ?Course;

    /**
     * Persitst(update or save) Course entity.
     *
     * @return Course
     */
    public static function persist(Course $course): Course;
}
