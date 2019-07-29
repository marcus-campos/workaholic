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
use Illuminate\Database\Eloquent\Builder;

class JobService
{
    /**
     * @var Job
     */
    private $job;

    /**
     * JobService constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

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
            $job = $this->job->find($id);
            return $job->fill($request)->save();
        }

        $job = $this->job->create($request);
        return $job;
    }

    /**
     * @return mixed
     */
    public function indexByClientId()
    {
        $jobs = $this->job->with(['jobCategory', 'userAddresses', 'userAddresses.city', 'user'])
            ->withCount([
                'proposals', 
                'proposals as pending_activity_count' => function (Builder $query) {
                    $query->where('has_activity', 1);
                }
            ])
            ->where('user_id', auth()->id());

        return $jobs;
    }

    /**
     * @return mixed
     */
    public function indexByWorker()
    {
        $jobs = $this->job->with(['jobCategory', 'userAddresses', 'userAddresses.city', 'proposals', 'user'])
            ->withCount('proposals')
            ->whereHas('proposals', function ($query) {
                $query->where('user_id', auth()->id());
            });

        return $jobs;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function indexAll()
    {
        $jobs = $this->job->with(['jobCategory', 'userAddresses', 'userAddresses.city', 'user'])
            ->withCount('proposals')
            ->whereDoesntHave('proposals', function ($query) {
                $query->where('status', 'accepted')
                    ->orWhere('status', 'rejected');
            });

        return $jobs;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getJob($id)
    {
        return $this->job->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getJobWithProposalsCount($id)
    {
        return  $this->job->with(['userAddresses', 'userAddresses.city'])
            ->withCount('proposals')->find($id);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $this->job->destroy($id);
    }
}