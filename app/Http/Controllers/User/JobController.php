<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\JobRequest;
use App\Models\City;
use App\Models\Job;
use App\Models\JobCategory;
use App\Util\DataMaker\DataMakerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    use DataMakerTrait;

    public function __construct()
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
    public function indexByUserId()
    {
        $jobs = $this->dataMaker(Job::with('jobCategory')
            ->where('user_id', auth()->id()));

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


    public function store(JobRequest $request)
    {
        $request = $request->all();
        $request['city_id'] = (new City)->cityFromToId($request['city_id']);
        $request['user_id'] = auth()->user()->id;
        Job::create($request);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);

        $request = $request->all();
        $request['city_id'] = (new City)->cityFromToId($request['city_id']);
        $request['user_id'] = auth()->user()->id;

        $job->fill($request)->save();

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
