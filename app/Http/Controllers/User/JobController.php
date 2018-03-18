<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\JobRequest;
use App\Models\City;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     *
     */
    public function showMyJobsClient()
    {
        $jobs = Job::with('jobCategory')->where('user_id', auth()->user()->id)->paginate(15);
        return view('app.user.job.my-jobs-client', compact('jobs'));
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
        return redirect()->to(route('user.dashboard.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
