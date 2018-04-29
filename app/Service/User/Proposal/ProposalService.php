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
     * @var Proposal
     */
    private $proposal;
    /**
     * @var Job
     */
    private $job;

    /**
     * ProposalService constructor.
     * @param Proposal $proposal
     * @param Job $job
     */
    public function __construct(Proposal $proposal, Job $job)
    {
        $this->proposal = $proposal;
        $this->job = $job;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function proposalsClientOrWorker($id)
    {
        //Client
        $proposals = $this->job->with([
            'jobCategory',
            'city',
            'proposals' => function ($query) {
                $query->where('status', '<>', 'rejected');
            },
            'proposals.user',
            'proposals.comments',
            'proposals.comments.user'
        ])->withCount('proposals')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        //Worker
        if (!$proposals or $proposals->count() < 1) {
            $proposals = $this->job->with([
                'jobCategory',
                'city',
                'proposals' => function ($query) {
                    $query->where('user_id', auth()->id());
                },
                'proposals.user',
                'proposals.comments',
                'proposals.comments.user'
            ])->withCount('proposals')
                ->where('id', $id)
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
            $proposal = $this->proposal->find($id);
            return $proposal->fill($request)->save();
        }

        return $this->proposal->create($request->all());
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function acceptProposal($id)
    {
        $proposal = $this->proposal->with('job')->find($id);

        $checkIfHasOneAcceptedProposal = $this->hasAcceptedProposal($proposal->job_id);

        if($checkIfHasOneAcceptedProposal) {
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
        $this->proposal->where('job_id', $proposal->job_id)
            ->where('status', '<>' ,'accepted')
            ->update(['status' => 'rejected']);

        return $acceptedProposal;
    }

    /**
     * @param $jobId
     * @return bool
     */
    public function hasAcceptedProposal($jobId)
    {
        $jobCount = $this->proposal->with(['proposals'])
            ->where('id', $jobId)
            ->whereHas('proposals', function ($query) {
                $query->where('status', 'accepted');
            })
            ->count();

        if ($jobCount > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $jobId
     * @param $userId
     * @return bool
     */
    public function hasAcceptedProposalForMe($jobId)
    {
        $jobCount = $this->proposal->with(['proposals'])
            ->where('id', $jobId)
            ->whereHas('proposals', function ($query) {
                $query->where('status', 'accepted')->where('user_id', auth()->id());
            })
            ->count();

        if ($jobCount > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $jobId
     * @return bool
     */
    public function iAmOwner($jobId)
    {
        $jobCount = $this->job->where('id', $jobId)
            ->where('user_id', auth()->id())
            ->count();

        if ($jobCount > 0) {
            return true;
        }

        return false;
    }
}