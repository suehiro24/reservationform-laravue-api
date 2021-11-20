<?php

namespace RsvForm\Domain\Repositories;

use Illuminate\Support\Collection;
use RsvForm\Domain\Models\Course\Course;

interface ICourseRepository
{
    /**
     * Get all Course entities.
     *
     * @return Course[]
     */
    public static function getAll(): Collection;

    /**
     * Find specific Course entity.
     *
     * @return Course|null
     */
    public static function find(int $id): ?Course;

    /**
     * Persitst(insert or update) Course entity.
     *
     * @return Course
     */
    public static function persist(Course $course): Course;

    /**
     * Set Delete Flag to Course entity.
     *
     * @return bool
     */
    public static function delete(int $id): bool;
}
