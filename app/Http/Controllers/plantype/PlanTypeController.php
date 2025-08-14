<?php

namespace App\Http\Controllers\plantype;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;
use App\Repositories\PlanType\PlanTypeInterface;

class PlanTypeController extends Controller
{
    protected $planTypeInterface;
    public function __construct(PlanTypeInterface $planTypeInterface)
    {
        $this->planTypeInterface  = $planTypeInterface;
    }
    public function index(Request $request)
    {
        return $this->planTypeInterface->index();
    }
    public function create()
    {
        return $this->planTypeInterface->create();
    }
    public function store(PlanRequest $planrequest)
    {
        return $this->planTypeInterface->store($planrequest);
    }

    public function delete(Request $request)
    {
        return  $this->planTypeInterface->delete($request);
    }


    public function edit(Request $request)
    {
        return  $this->planTypeInterface->edit($request->id);
    }


    public function update(PlanRequest $planrequest)
    {
        return  $this->planTypeInterface->update($planrequest);
    }
}
