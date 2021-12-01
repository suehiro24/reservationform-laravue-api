<?php

namespace RsvForm\Domain\Models\ApptSlot;

use DateTime;
use Exception;
use RsvForm\Domain\Models\Course\Course;

final class ApptSlot
{
    /**
     * 予約枠ID
     * @var int|null
     */
    private ?int $id;

    /**
     * コース
     * @var Course
     */
    private Course $course;

    /**
     * 予約枠名
     * @var string
     */
    private string $name;

    /**
     * 料金
     * @var int|null
     */
    private ?int $price;

    /**
     * 定員
     * @var int
     */
    private int $capacity;

    /**
     * 会場
     * @var string|null
     */
    private ?string $location;

    /**
     * 予約者数
     * @var int
     */
    private int $reservations;

    /**
     * 開始日時
     * @var DateTime
     */
    private DateTime $start;

    /**
     * 終了日時
     * @var DateTime
     */
    private DateTime $end;

    /**
     * 満員フラグ
     * @var boolean
     */
    private bool $isFull;

    private function __construct(
        ?int $id = null,
        Course $course,
        string $name,
        ?int $price = null,
        int $capacity,
        ?string $location = null,
        ?string $note = null,
        int $reservations,
        DateTime $start,
        DateTime $end,
    ) {
        // 予約枠ID
        $this->id = $id;

        // コース
        $this->course = $course;

        // 予約枠名
        if (mb_strlen($name) > 100) {
            throw new Exception('予約枠名は100文字以内で入力してください');
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

        // 予約者詳細
        // TODO: 仕様決め
        $this->note = null;

        // 予約者数
        if ($reservations > $capacity) {
            throw new Exception('予約者数が定員を上回っています');
        }
        $this->reservations = $reservations;

        // 開始日時
        $this->start = $start;

        // 終了日時
        if ($end < $start) {
            throw new Exception('終了日時には開始日時以降の日時を入力してください');
        }
        $this->end = $end;

        // 満員フラグ
        $this->isFull = $reservations >= $capacity;
    }

    public static function create(
        Course $course,
        DateTime $start,
        DateTime $end,
    ): ApptSlot {
        return new ApptSlot(
            null,
            $course,
            $course->getName(),
            $course->getPrice(),
            $course->getCapacity(),
            $course->getLocation(),
            null,
            0,
            $start,
            $end,
        );
    }

    public static function reconstruct(
        int $id,
        Course $course,
        string $name,
        ?int $price = null,
        int $capacity,
        ?string $location = null,
        ?string $note = null,
        int $reservations,
        DateTime $start,
        DateTime $end,
    ): ApptSlot {
        return new ApptSlot($id, $course, $name, $price, $capacity, $location, $note, $reservations, $start, $end);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
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
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @return bool
     */
    public function getReservations(): bool
    {
        return $this->reservations;
    }

    /**
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * @return bool
     */
    public function getIsFull(): bool
    {
        return $this->isFull;
    }
}
