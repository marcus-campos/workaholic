<?php
/**
 * Created by PhpStorm.
 * User: marcus-campos
 * Date: 08/04/18
 * Time: 11:22
 */

namespace App\Service\User\Proposal;


use App\Models\Job;
use App\Models\Proposal;
use Illuminate\Http\Response;

class ProposalService
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function proposalsClientOrWorker($id)
    {
        //Client
        $proposals = Job::with([
            'jobCategory',
            'city',
            'proposals' => function ($query) {
                $query->where('status', '<>', 'rejected');
            },
            'proposals.user',
            'proposals.comments',
            'proposals.comments.user'
        ])->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        //Worker
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

        return $proposals;
    }

    /**
     * @param $request
     * @param null $id
     * @return mixed
     */
    public function persist($request, $id = null)
    {
        $request['user_id'] = auth()->id();
        $request['gross_value'] = 0.00;

        if ($id) {
            $proposal = Proposal::find($id);
            return $proposal->fill($request)->save();
        }

        return Proposal::create($request->all());
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function acceptProposal($id)
    {
        $proposal = Proposal::with('job')->find($id);

        $checkIfHasOneAcceptedProposal = Proposal::where('job_id', $proposal->job_id)
            ->where('status', 'accepted')
            ->count();

        if($checkIfHasOneAcceptedProposal > 0) {
            return [
                'status' => Response::HTTP_CONFLICT,
                'error' => 'Ja existe uma proposta aceita'
            ];
        }

        if (auth()->id() != $proposal->job->user_id) {
            return [
                'status' => Response::HTTP_UNAUTHORIZED,
                'error' => 'Você não é o dono deste trabalho'
            ];
        }

        $proposal->status = 'accepted';
        $acceptedProposal = $proposal->save();

        //Atualizando o status das outras propostas
        Proposal::where('job_id', $proposal->job_id)
            ->where('status', '<>' ,'accepted')
            ->update(['status' => 'rejected']);

        return $acceptedProposal;
    }
}