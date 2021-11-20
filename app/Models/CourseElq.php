<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseElq extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'courses';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_finished' => 'boolean',
        'is_deleted' => 'boolean',
    ];
}
