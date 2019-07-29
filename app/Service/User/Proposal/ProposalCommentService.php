<?php
/**
 * Created by PhpStorm.
 * User: marcus-campos
 * Date: 08/04/18
 * Time: 11:28
 */

namespace App\Service\User\Proposal;


use App\Models\ProposalComment;
use App\Models\Proposal;

class ProposalCommentService
{
    /**
     * @var ProposalComment
     */
    private $proposalComment;

    /**
     * @var Proposal
     */
    private $proposal;

    /**
     * ProposalCommentService constructor.
     * @param ProposalComment $proposalComment
     * @param Proposal $proposal
     */
    public function __construct(ProposalComment $proposalComment, Proposal $proposal)
    {
        $this->proposalComment = $proposalComment;
        $this->proposal = $proposal;
    }

    public function persist($request)
    {
        $request['user_id'] = auth()->id();
        $comment = $this->proposalComment->create($request->all());

        $updated = $this->proposal->where('id', $request->proposal_id)
            ->update(['has_activity' => true]);

        return $comment;
    }
}