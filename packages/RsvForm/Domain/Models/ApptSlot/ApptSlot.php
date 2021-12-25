<?php

namespace RsvForm\Domain\Models\ApptSlot;

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
     * 時間枠(開始, 終了日時)
     * @var TimeSlot
     */
    private TimeSlot $timeSlot;

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
        TimeSlot $timeSlot,
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
        if (mb_strlen($note) > 3000) {
            throw new Exception('予約者詳細は3000文字以内で入力してください');
        }
        $this->note = $note;

        // 予約者数
        if ($reservations > $capacity) {
            throw new Exception('予約者数が定員を上回っています');
        }
        $this->reservations = $reservations;

        // 時間枠(開始, 終了日時)
        $this->timeSlot = $timeSlot;

        // 満員フラグ
        $this->isFull = $reservations >= $capacity;
    }

    public static function create(
        Course $course,
        TimeSlot $timeSlot
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
            $timeSlot
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
        TimeSlot $timeSlot
    ): ApptSlot {
        return new ApptSlot(
            $id,
            $course,
            $name,
            $price,
            $capacity,
            $location,
            $note,
            $reservations,
            $timeSlot
        );
    }

    /**
     * 予約受付
     *
     * @param ApptSlot $apptSlot
     * @param array $userInfo
     * @return ApptSlot
     */
    public static function reserve(ApptSlot $apptSlot, array $userInfo): ApptSlot {
        $noteUpdated = $apptSlot->getNote().'\n---------------';
        foreach ($userInfo as $key => $value) {
            $noteUpdated = $noteUpdated.'\n ●'.$key.'\n'.$value;
        }
        $reservationsUpdated = $apptSlot->getReservations() + 1;

        return self::reconstruct(
            $apptSlot->getId(),
            $apptSlot->getCourse(),
            $apptSlot->getName(),
            $apptSlot->getPrice(),
            $apptSlot->getCapacity(),
            $apptSlot->getLocation(),
            $noteUpdated,
            $reservationsUpdated,
            $apptSlot->getTimeSlot()
        );
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
     * @return int
     */
    public function getReservations(): int
    {
        return $this->reservations;
    }

    /**
     * @return TimeSlot
     */
    public function getTimeSlot(): TimeSlot
    {
        return $this->timeSlot;
    }

    /**
     * @return bool
     */
    public function getIsFull(): bool
    {
        return $this->isFull;
    }
}
