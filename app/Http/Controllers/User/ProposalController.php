<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProposalRequest;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = Proposal::with(['job', 'user'])->find($id);

        if ($proposal) {
            if (!($proposal->user_id == auth()->id() or
                $proposal->job->user_id == auth()->id())) {
                return response()->json([
                    'status' => Response::HTTP_FORBIDDEN,
                    'error' => 'Você não pode visualizar esta proposta'
                ], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Você ainda não fez uma proposta para este trabalho'
            ], Response::HTTP_NOT_FOUND);
        }

        return $proposal;
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function showJobProposal($id)
    {
        $proposal = Proposal::with(['job', 'user'])
            ->where('user_id', auth()->id())
            ->where('job_id', $id)
            ->get();

        if ($proposal->count() < 1) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => 'Você ainda não fez uma proposta para este trabalho'
            ], Response::HTTP_NOT_FOUND);
        }

        return $proposal;
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
