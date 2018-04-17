<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProposalComment extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'user_id',
        'proposal_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
