<?php
/**
 * User: marcus-campos
 * Date: 08/04/18
 * Time: 11:00
 */

namespace App\Service\User\Job;


use App\Models\City;
use App\Models\Job;
use http\Env\Request;

class JobService
{
    /**
     * @param $request
     * @param null $id
     * @return mixed
     */
    public function persist($request, $id = null)
    {
        $request = $request->all();
        $request['user_id'] = auth()->user()->id;

        if ($id) {
            $job = Job::find($id);
            return $job->fill($request)->save();
        }

        $job = Job::create($request);
        return $job;
    }

    /**
     * @return mixed
     */
    public function indexByClientId()
    {
        $jobs = Job::with(['jobCategory', 'city'])
            ->withCount('proposals')
            ->where('user_id', auth()->id());

        return $jobs;
    }

    /**
     * @return mixed
     */
    public function indexByWorker()
    {
        $jobs = Job::with(['jobCategory', 'city', 'proposals'])
            ->withCount('proposals')
            ->whereHas('proposals', function ($query) {
                $query->where('user_id', auth()->id());
            }
        );

        return $jobs;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function indexAll()
    {
        $jobs = Job::with(['jobCategory', 'city'])
            ->withCount('proposals')
            ->whereDoesntHave('proposals', function ($query) {
                $query->where('status', 'accepted')
                    ->orWhere('status', 'rejected');
            });

        return $jobs;
    }


    /**
     * @param $id
     */
    public function destroy($id)
    {
        Job::destroy($id);
    }
}