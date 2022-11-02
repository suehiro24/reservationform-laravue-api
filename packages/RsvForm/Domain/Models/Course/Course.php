<?php

namespace RsvForm\Domain\Models\Course;

use Exception;

final class Course
{
    /**
     * コースID
     *
     * @var int|null
     */
    private ?int $id;

    /**
     * コース名
     *
     * @var string
     */
    private string $name;

    /**
     * 料金
     *
     * @var int|null
     */
    private ?int $price;

    /**
     * 定員
     *
     * @var int
     */
    private int $capacity;

    /**
     * 会場
     *
     * @var string|null
     */
    private ?string $location;

    /**
     * 説明文
     *
     * @var string|null
     */
    private ?string $description;

    /**
     * 閉講フラグ
     *
     * @var bool
     */
    private bool $isFinished;

    private function __construct(
        ?int $id,
        string $name,
        ?int $price,
        int $capacity,
        ?string $location,
        ?string $description,
        bool $isFinished,
    ) {
        // コースID
        $this->id = $id;

        // コース名
        if (mb_strlen($name) > 100) {
            throw new Exception('コース名は100文字以内で入力してください');
        }
        $this->name = $name;

        // 料金
        if ($price < 0) {
            throw new Exception('料金は0以上の数値を入力してください');
        }
        $this->price = $price;

        // 定員
        if ($capacity < 0) {
            throw new Exception('定員は0以上の数値を入力してください');
        }
        $this->capacity = $capacity;

        // 会場
        if (mb_strlen($location) > 100) {
            throw new Exception('会場は100文字以内で入力してください');
        }
        $this->location = $location;

        // 説明文
        if (mb_strlen($description) > '3000') {
            throw new Exception('説明文は3000文字以内で入力してください');
        }
        $this->description = $description;

        // 閉講フラグ
        $this->isFinished = $isFinished;
    }

    public static function create(
        string $name,
        ?int $price,
        int $capacity,
        ?string $location = null,
        ?string $description = null,
    ): Course {
        return new Course(null, $name, $price, $capacity, $location, $description, false, false);
    }

    public static function reconstruct(
        int $id,
        string $name,
        ?int $price,
        int $capacity,
        ?string $location,
        ?string $description,
        bool $isFinished,
    ): Course {
        return new Course($id, $name, $price, $capacity, $location, $description, $isFinished);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function getIsFinished(): bool
    {
        return $this->isFinished;
    }
}
