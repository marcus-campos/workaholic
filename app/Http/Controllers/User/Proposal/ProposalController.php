<?php

namespace App\Http\Controllers\User\Proposal;

use App\Http\Requests\ProposalRequest;
use App\Models\Job;
use App\Models\Proposal;
use App\Service\User\Proposal\ProposalService;
use App\Util\DataMaker\DataMakerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProposalController extends Controller
{
    use DataMakerTrait;
    /**
     * @var ProposalService
     */
    private $proposalService;

    /**
     * ProposalController constructor.
     * @param ProposalService $proposalService
     */
    public function __construct(ProposalService $proposalService)
    {
        $this->proposalService = $proposalService;
    }

    /**
     * Store a newly created resource in storage.
     * @param ProposalRequest $request
     * @return mixed
     */
    public function store(ProposalRequest $request)
    {
        $jobId = $request->all()['job_id'];

        if ($this->proposalService->hasAcceptedProposal($jobId)) {
            return [
                'status' => Response::HTTP_CONFLICT,
                'error' => 'Ja existe uma proposta aceita para este serviço'
            ];
        }

        $proposal = $this->proposalService->persist($request);
        return $proposal;
    }

    /**
     * @param Request $request
     * @return array|bool|\Illuminate\Http\JsonResponse
     */
    public function acceptProposal(Request $request)
    {
        $acceptedProposal = $this->proposalService->acceptProposal($request->all()['id']);

        if(isset($acceptedProposal['status'])) {
            return response()->json($acceptedProposal, $acceptedProposal['status']);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'msg' => 'Proposta aceita com sucesso!'
        ], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return array|bool|\Illuminate\Http\JsonResponse
     */
    public function updateActivities(Request $request)
    {
        $update = $this->proposalService->updateActivities($request->all()['id']);

        return response()->json([
            'status' => Response::HTTP_OK,
            'msg' => 'Atividades atualizadas com sucesso!'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param $jobId
     * @return \Illuminate\Http\Response
     */
    public function show($jobId)
    {
        return view('app.user.job.proposal.proposal', compact('jobId'));
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\JsonResponse|null|object|static
     */
    public function showJsonJobProposal($id)
    {
        $proposals = $this->proposalService->proposalsClientOrWorker($id);

        if (!$proposals->proposals or $proposals->proposals->count() < 1) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Você ainda não fez uma proposta para este trabalho'
            ], Response::HTTP_NOT_FOUND);
        }

        return $proposals;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
