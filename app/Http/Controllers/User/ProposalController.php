<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProposalRequest;
use App\Models\Job;
use App\Models\Proposal;
use App\Util\DataMaker\DataMakerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalController extends Controller
{
    use DataMakerTrait;

    /**
     * Store a newly created resource in storage.
     * @param ProposalRequest $request
     */
    public function store(ProposalRequest $request)
    {
        $request['user_id'] = auth()->id();
        $request['gross_value'] = 0.00;

        return Proposal::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = Proposal::with(['job', 'user'])->find($id);
        return $proposal;
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
