<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'neighborhood',
        'city_id',
        'remote',
        'initial_time',
        'final_time',
        'specific_date',
        'job_category_id',
        'user_id'
    ];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }
}
