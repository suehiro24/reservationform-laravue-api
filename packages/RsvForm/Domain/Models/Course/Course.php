<?php

namespace RsvForm\Domain\Models\Course;

use Exception;

final class Course
{
    /**
     * @var int|null
     */
    private ?int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var int|null
     */
    private ?int $price;

    /**
     * @var int
     */
    private int $capacity;

    /**
     * @var string|null
     */
    private ?string $location;

    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @var bool
     */
    private bool $isFinished;

    private function __construct(
        ?int $id = null,
        string $name,
        ?int $price = null,
        int $capacity,
        ?string $location = null,
        ?string $description = null,
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
        if (mb_strlen($price) < 0) {
            throw new Exception('料金は0以上の数値を入力してください');
        }
        $this->price = $price;

        // 定員
        if (mb_strlen($capacity) < 0) {
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

        $this->isFinished = $isFinished;
    }

    public static function create(
        string $name,
        ?int $price = null,
        int $capacity,
        ?string $location = null,
        ?string $description = null,
        bool $isFinished,
    ): Course
    {
        return new Course(null, $name, $price, $capacity, $location, $description, $isFinished, false);
    }

    public static function reconscruct(
        int $id,
        string $name,
        ?int $price = null,
        int $capacity,
        ?string $location = null,
        ?string $description = null,
        bool $isFinished,
    ): Course
    {
        return new Course($id, $name, $price, $capacity, $location, $description, $isFinished );
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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     */
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $location
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function getIsFinished(): bool
    {
        return $this->isFinished;
    }

    /**
     * @param bool $isFinished
     */
    public function setIsFinished(bool $isFinished): void
    {
        $this->isFinished = $isFinished;
    }
}
