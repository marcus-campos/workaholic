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
        $request['city_id'] = (new City)->cityFromToId($request['city_id']);
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
            ->where('user_id', auth()->id());

        return $jobs;
    }

    /**
     * @return mixed
     */
    public function indexByWorker()
    {
        $jobs = Job::with(['jobCategory', 'city', 'proposals'])
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
        $jobs = Job::with(['jobCategory', 'city', 'proposals'])
            ->whereHas('proposals', function ($query) {
                $query->where('status', 'waiting');
            });

        return $jobs;
    }

    /**
     * @param $jobId
     * @return bool
     */
    public function hasAcceptedProposal($jobId)
    {
        $jobCount = Job::with(['proposals'])
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
    public function hasAcceptedProposalForMe($jobId, $userId)
    {
        $jobCount = Job::with(['proposals'])
            ->where('id', $jobId)
            ->whereHas('proposals', function ($query) use($userId) {
                $query->where('status', 'accepted')->where('user_id', $userId);
            })
            ->count();

        if ($jobCount > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Job::destroy($id);
    }
}