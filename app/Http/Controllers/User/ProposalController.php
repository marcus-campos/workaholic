<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProposalRequest;
use App\Models\Job;
use App\Models\Proposal;
use App\Util\DataMaker\DataMakerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProposalController extends Controller
{
    use DataMakerTrait;

    /**
     * Store a newly created resource in storage.
     * @param ProposalRequest $request
     */
    public function store(ProposalRequest $request)
    {
        $request['user_id'] = auth()->id();
        $request['gross_value'] = 0.00;

        return Proposal::create($request->all());
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
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function showJsonJobProposal($id)
    {
        $proposals = Job::with([
            'jobCategory',
            'city',
            'proposals',
            'proposals.user',
            'proposals.comments',
            'proposals.comments.user'
        ])->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$proposals or $proposals->count() < 1) {
            $proposals = Job::with([
                'jobCategory',
                'city',
                'proposals' => function ($query) {
                    $query->where('user_id', auth()->id());
                },
                'proposals.user',
                'proposals.comments',
                'proposals.comments.user'
            ])->where('id', $id)
                ->first();
        }

        if (!$proposals->proposals or $proposals->proposals->count() < 1) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Você ainda não fez uma proposta para este trabalho'
            ], Response::HTTP_NOT_FOUND);
        }
        $data = $proposals;
        return $data;
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
