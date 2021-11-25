<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApptSlotElq extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'appointment_slots';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_full' => 'boolean',
        'start' => 'datetime',
        'end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the CourseElq that owns the ApptSlotElq
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseElq(): BelongsTo
    {
        return $this->belongsTo(CourseElq::class, 'course_id', 'id');
    }
}
