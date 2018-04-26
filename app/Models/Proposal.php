<?php

namespace App\Models;

class Proposal extends BaseModel
{
    protected $fillable = [
        'description',
        'net_value',
        'gross_value',
        'time_to_finish_the_job',
        'promoted',
        'status',
        'user_id',
        'job_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(ProposalComment::class);
    }
}
