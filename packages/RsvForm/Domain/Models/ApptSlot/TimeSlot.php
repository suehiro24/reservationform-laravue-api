<?php

namespace RsvForm\Domain\Models\ApptSlot;

use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Date;
use RsvForm\Domain\Models\Course\Course;

final class TimeSlot
{
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
     * @param string|DateTime $start
     * @param string $end
     */
    public function __construct(
        string|DateTime $start,
        string|DateTime $end,
    ) {
        if (! ($start instanceof DateTime)) {
            $start = self::validateIso8601Date($start);
        }
        if (! ($end instanceof DateTime)) {
            $end = self::validateIso8601Date($end);
        }

        // 開始日時
        $this->start = $start;

        // 終了日時
        if ($end < $start) {
            throw new Exception('終了日時には開始日時以降の日時を入力してください');
        }
        $this->end = $end;
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
     * ISO8601形式の日付文字列をDate型に変換する (拡張形式のみ)
     *
     * @param string $isoDatetime The string has the format of ISO8601(extended format).
     * @return Datetime
     */
    private static function validateIso8601Date (string $isoDatetime): DateTime
    {
        $matches = [];
        $isValidFormat = preg_match(
            '/^'.
                '(\d{1,4})'.                 // 年 (任意の4桁の数)
                '-'.                         // -
                '(0[1-9]|1[012])'.           // 月 (01-12)
                '-'.                         // -
                '(0[1-9]|[12][0-9]|3[01])'.  // 日 (01-31)
                'T'.                         // T
                '([0-1][0-9]|2[0-4])'.       // 時 (00-24)
                ':'.                         // :
                '[0-5][0-9]'.                // 分 (00-59)
                ':'.                         // :
                '[0-5][0-9]'.                // 秒 (00-59)
                                             // UTC or 任意のTZ (+ or -)(00-24):(00-59)
                '('.
                    'Z|'.
                    '(\+|-)([01][0-9]|2[0-4]):?([0-5][0-9])?'.
                ')'.
            '$/',
            $isoDatetime, $matches
        ) === 1;
        $isValidDate = true;

        try {
            $isValidDate = checkdate($matches[2], $matches[3], $matches[1]);
        } catch (\Exception $e) {
            $isValidDate = false;
        }

        if ($isValidFormat && $isValidDate) {
            return new Carbon($isoDatetime);
        } else {
            throw new Exception('日付の形式に誤りがあります。ISO8601(Extended format)での入力を行ってください。');
        };
    }
}
