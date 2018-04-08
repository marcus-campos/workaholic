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

class ProposalService
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function proposalsClientOrWorker($id)
    {
        $proposals = Job::with([
            'jobCategory',
            'city',
            'proposals',
            'proposals.user',
            'proposals.comments',
            'proposals.comments.user'
        ])->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$proposals or $proposals->count() < 1) {
            $proposals = Job::with([
                'jobCategory',
                'city',
                'proposals' => function ($query) {
                    $query->where('user_id', auth()->id());
                },
                'proposals.user',
                'proposals.comments',
                'proposals.comments.user'
            ])->where('id', $id)
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
            $proposal = Proposal::find($id);
            return $proposal->fill($request)->save();
        }

        return Proposal::create($request->all());
    }
}