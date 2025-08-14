<?php

namespace App\Http\Controllers\admin\status;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Repositories\Status\StatusInterface;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusrepository;
    public function __construct(StatusInterface $statusrepository)
    {
        $this->statusrepository  = $statusrepository;
    }
    public function index(Request $request)
    {
        return $this->statusrepository->index();
    }
    public function create()
    {
        return $this->statusrepository->create();
    }
    public function store(StatusRequest $data)
    {
        return $this->statusrepository->store($data);
    }

    public function delete(Request $request)
    {
        return  $this->statusrepository->delete($request);
    }


    public function edit(Request $request)
    {
        return  $this->statusrepository->edit($request->id);
    }


    public function update(StatusRequest $data)
    {
        return  $this->statusrepository->update($data);
    }
}
