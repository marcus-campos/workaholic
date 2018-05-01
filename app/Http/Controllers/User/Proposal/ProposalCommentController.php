<?php

namespace App\Http\Controllers\User\Proposal;

use App\Http\Requests\ProposalCommentsRequest;
use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalComment;
use App\Service\User\Job\JobService;
use App\Service\User\Proposal\ProposalCommentService;
use App\Service\User\Proposal\ProposalService;
use Illuminate\Http\Response;

class ProposalCommentController extends Controller
{
    /**
     * @var ProposalCommentService
     */
    private $proposalCommentService;
    /**
     * @var ProposalService
     */
    private $proposalService;


    /**
     * ProposalCommentController constructor.
     * @param ProposalCommentService $proposalCommentService
     * @param ProposalService $proposalService
     */
    public function __construct(ProposalCommentService $proposalCommentService, ProposalService $proposalService)
    {
        $this->proposalCommentService = $proposalCommentService;
        $this->proposalService = $proposalService;
    }

    /**
     * @param ProposalCommentsRequest $request
     * @return mixed
     */
    public function store(ProposalCommentsRequest $request)
    {
        $requestAll = $request->all();
        $jobId = Proposal::find($requestAll['proposal_id'])->job_id;

        if ($this->proposalService->hasAcceptedProposal($jobId)) {
            if (!$this->proposalService->hasAcceptedProposalForMe($jobId)) {
                if (!$this->proposalService->iAmOwner($jobId)) {
                    return response()->json([
                        'status' => Response::HTTP_UNAUTHORIZED,
                        'msg' => 'Você não pode comentar em um serviço cujo a sua proposta não foi aceita.'
                    ], Response::HTTP_UNAUTHORIZED);
                }
            }
        }

        $proposalComment = $this->proposalCommentService->persist($request);
        return $proposalComment;
    }
}
