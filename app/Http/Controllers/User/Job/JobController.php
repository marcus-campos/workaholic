<?php

namespace App\Http\Controllers\User\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\JobCategory;
use App\Service\User\Job\JobService;
use App\Service\User\Proposal\ProposalService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * @var JobService
     */
    private $jobService;
    /**
     * @var ProposalService
     */
    private $proposalService;

    /**
     * JobController constructor.
     * @param JobService $jobService
     * @param ProposalService $proposalService
     */
    public function __construct(JobService $jobService, ProposalService $proposalService)
    {
        $this->jobService = $jobService;
        $this->proposalService = $proposalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userType = auth()->user()->role;
        $return = [];
        
        if($userType == 'company') {
            $return = $this->jobService->indexByCompany();
        }

        if($userType == 'freelancer') {
            $return = $this->jobService->indexByFreelancer();
        }

        if ($userType == 'admin') {
            $request = $this->jobService->indexAll();
        }

        return reply($return);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByCompanyAccepted()
    {
        $jobs = $this->jobService->indexByCompanyStatus('accepted');
        return reply($jobs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByClientIdDone()
    {
        $jobs = $this->jobService->indexByCompanyStatus('done');
        return reply($jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $jobCategories = JobCategory::all();
        return $jobCategories;
    }

    /**
     * @param JobRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JobRequest $request)
    {
        $job = $this->jobService->persist($request);
        return reply($job);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function job($id)
    {
        if ($this->proposalService->hasAcceptedProposal($id)) {
            if (!$this->proposalService->hasAcceptedProposalForMe($id)) {
                if (!$this->proposalService->iAmOwner($id)) {
                    return reply([
                        'msg' =>  'Invalid Permissions'
                    ]);
                }
            }
        }

        $job = $this->jobService->getJobWithProposalsCount($id);
        return reply($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(JobRequest $request, $id)
    {
        $job = $this->jobService->persist($request, $id);
        $job = ['msg' => 'Successfully updated'];
        return reply($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = $this->jobService->getJob($id);

        if (!$job) {
            return reply([
                'msg' => 'No job found with this id'
            ]);
        }

        //Validando se a pessoa que está acessando pode apagar este job
        if ($job->user_id != auth()->id() || auth()->user()->role == 'admin') {
            return reply([
                'msg' => 'Invalid Permissions'
            ]);
        }

        $result = $this->jobService->destroy($id);
        $result = ['msg' => $result.' job(s) deleted'];

        return reply($result);
    }
}
