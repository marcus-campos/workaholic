<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\JobRequest;
use App\Models\City;
use App\Models\Job;
use App\Models\JobCategory;
use App\Service\User\Job\JobService;
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
     * JobController constructor.
     * @param JobService $jobService
     */
    public function __construct(JobService $jobService)
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
        $jobs = $this->dataMaker(Job::with(['jobCategory', 'city'])
            ->where('user_id', auth()->id()));

        return $jobs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByWorkerId()
    {
        $jobs = $this->dataMaker(Job::with(['jobCategory', 'city', 'proposals'])
            ->whereHas('proposals', function ($query) {
                $query->where('user_id', auth()->id());
            }
        ));

        return $jobs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        $jobs = $this->dataMaker(Job::with('jobCategory'));
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
        $job = Job::find($id);
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
        Job::destroy($id);
        return redirect()->to(route('user.job.client'));
    }
}
