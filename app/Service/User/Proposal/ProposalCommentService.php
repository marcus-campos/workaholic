<?php
/**
 * Created by PhpStorm.
 * User: marcus-campos
 * Date: 08/04/18
 * Time: 11:28
 */

namespace App\Service\User\Proposal;


use App\Models\ProposalComment;

class ProposalCommentService
{
    public function persist($request)
    {
        $request['user_id'] = auth()->id();
        return ProposalComment::create($request->all());
    }
}