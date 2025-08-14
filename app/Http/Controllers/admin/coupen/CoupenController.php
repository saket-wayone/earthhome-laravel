<?php

namespace App\Http\Controllers\admin\coupen;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoupenRequest;
use App\Repositories\Coupen\CoupenInterface;
use Illuminate\Http\Request;

class CoupenController extends Controller
{
    protected $coupenInterface;

    public function __construct(CoupenInterface $coupenInterface)
    {
        return $this->coupenInterface =  $coupenInterface;
    }

    public function index()
    {
        return $this->coupenInterface->index();
    }
    public function create()
    {
        return $this->coupenInterface->create();
    }
    public function store(CoupenRequest $coupenRequest)
    {

        return $this->coupenInterface->store($coupenRequest);
    }

    public function delete(Request $request)
    {
        return  $this->coupenInterface->delete($request);
    }

    public function edit(Request $request)
    {
        return  $this->coupenInterface->edit($request->id);
    }

    public function update(CoupenRequest $coupenRequest)
    {
        return  $this->coupenInterface->update($coupenRequest);
    }

    public function applycoupen(Request $request){
        return  $this->coupenInterface->applycoupen($request->all());
    }

}
