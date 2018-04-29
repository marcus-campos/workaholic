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
    /**
     * @var ProposalComment
     */
    private $proposalComment;

    /**
     * ProposalCommentService constructor.
     * @param ProposalComment $proposalComment
     */
    public function __construct(ProposalComment $proposalComment)
    {
        $this->proposalComment = $proposalComment;
    }

    public function persist($request)
    {
        $request['user_id'] = auth()->id();
        return $this->proposalComment->create($request->all());
    }
}