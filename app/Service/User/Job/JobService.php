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
}