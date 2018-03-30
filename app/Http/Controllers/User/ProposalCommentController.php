<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProposalCommentsRequest;
use App\Http\Controllers\Controller;
use App\Models\ProposalComment;

class ProposalCommentController extends Controller
{
    public function store(ProposalCommentsRequest $request)
    {
        $request['user_id'] = auth()->id();
        return ProposalComment::create($request->all());
    }
}
