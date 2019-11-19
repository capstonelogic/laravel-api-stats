<?php

namespace CapstoneLogic\Stats\Http\Controllers\Api;

use Illuminate\Http\Request;
use Woodoocoder\LaravelHelpers\Api\Controller;
use Woodoocoder\LaravelHelpers\Api\Response\ApiMessage;
use Woodoocoder\LaravelHelpers\Api\Response\ApiStatus;
use CapstoneLogic\Stats\Model\Stats;
use CapstoneLogic\Stats\Resource\StatsResource;
use CapstoneLogic\Stats\Repository\StatsRepository;
use CapstoneLogic\Stats\Http\Request\CreateRequest;
use CapstoneLogic\Stats\Http\Request\UpdateRequest;

class StatsController extends Controller
{

    private $statsRepo;

    public function __construct(StatsRepository $statsRepo) {
        $this->statsRepo = $statsRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function counters(Request $request)
    {
        return StatsResource::collection($this->statsRepo->counters());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        return new StatsResource($this->statsRepo->create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stats $stats)
    {
        return new StatsResource($stats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Stats $stats)
    {
        $isUpdated = $this->statsRepo->update($request->all(), $stats->id);
        
        if($isUpdated) {
            $stats = $this->statsRepo->find($stats->id);
            return new StatsResource($stats);
        }
        else {
            return new StatsResource($stats, ApiStatus::ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stats $stats)
    {
        if($stats->delete()) {
            return new ApiMessage();
        }
        else {
            return new ApiMessage(ApiStatus::ERROR);
        }
    }
}
