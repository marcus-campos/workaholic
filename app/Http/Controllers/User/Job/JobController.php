<?php

namespace App\Http\Controllers\User\Job;

use App\Http\Requests\JobRequest;
use App\Models\City;
use App\Models\Job;
use App\Models\JobCategory;
use App\Service\User\Job\JobService;
use App\Service\User\Proposal\ProposalService;
use App\Util\DataMaker\DataMakerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    use DataMakerTrait;
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
        $this->setFilterFillable([
            'title',
            'description',
            'neighborhood',
            'city_id',
            'remote',
            'initial_time',
            'final_time',
            'specific_date',
            'job_category_id'
        ]);

        $this->setOrderByFillable([
            'title',
            'created_at',
            'updated_at',
        ]);

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
        return view('app.user.job.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByClientId()
    {
        $jobs = $this->dataMaker($this->jobService->indexByClientId());
        return $jobs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByWorkerId()
    {
        $jobs = $this->dataMaker($this->jobService->indexByWorker());
        return $jobs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        $jobs = $this->dataMaker($this->jobService->indexAll());
        return $jobs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobCategories = JobCategory::all();
        return view('app.user.job.add', compact('jobCategories'));
    }


    /**
     * @param JobRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JobRequest $request)
    {
        $this->jobService->persist($request);
        return redirect()->to(route('user.job.client'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Redireciona se a pessoa ja tiver 1 proposta aceita
        if ($this->proposalService->hasAcceptedProposal($id)) {
            if (!$this->proposalService->hasAcceptedProposalForMe($id)) {
                if (!$this->proposalService->iAmOwner($id)) {
                    return redirect()->to(route('user.job.index'));
                }
            }
        }

        $job = Job::withCount('proposals')->find($id);
        return view('app.user.job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobCategories = JobCategory::all();
        $job = Job::find($id);

        //Validando se a pessoa que está acessando pode editar este job
        if ($job->user_id != auth()->id()) {
            return redirect()->to(route('user.job.index'));
        }

        return view('app.user.job.edit', compact('job', 'jobCategories'));
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
        $this->jobService->persist($request, $id);
        return redirect()->to(route('user.job.client'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        //Validando se a pessoa que está acessando pode apagar este job
        if ($job->user_id != auth()->id()) {
            return redirect()->to(route('user.job.index'));
        }

        $this->jobService->destroy($id);
        return redirect()->to(route('user.job.client'));
    }
}
