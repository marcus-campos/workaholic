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
    
        $proposal = $this->proposal->with('user')->where('id', $request->proposal_id);
        $updated = $proposal->update(['has_activity' => true]);

        if(auth()->user()->role == 'company') {
            $proposal = $proposal->first();
            \Slack::to('@'.$proposal->user->slack_user)->send("Olá ".$proposal->user->name."! O ".auth()->user()->name." acabou de comentar em sua proposta! Estou enviando o link da proposta para lhe economizar tempo. Segue o link: ".url("/user/proposal/job/{$proposal->job_id}"));
        }

        return $comment;
    }
}