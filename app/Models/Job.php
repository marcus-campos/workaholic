<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends BaseModel
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
