<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProposalCommentsRequest;
use App\Http\Controllers\Controller;
use App\Models\ProposalComment;
use App\Service\User\Proposal\ProposalCommentService;

class ProposalCommentController extends Controller
{
    /**
     * @var ProposalCommentService
     */
    private $proposalCommentService;

    /**
     * ProposalCommentController constructor.
     * @param ProposalCommentService $proposalCommentService
     */
    public function __construct(ProposalCommentService $proposalCommentService)
    {
        $this->proposalCommentService = $proposalCommentService;
    }

    /**
     * @param ProposalCommentsRequest $request
     * @return mixed
     */
    public function store(ProposalCommentsRequest $request)
    {
        $proposalComment = $this->proposalCommentService->persist($request);
        return $proposalComment;
    }
}
