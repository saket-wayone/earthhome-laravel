<?php

namespace App\Http\Controllers\admin\Source;

use App\Http\Controllers\Controller;
use App\Http\Requests\SourceRequest;
use App\Repositories\Source\SourceInterface;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    protected $sourceRepository;
    public function __construct(SourceInterface $sourceRepository)
    {
        $this->sourceRepository  = $sourceRepository;
    }
    public function index(Request $request)
    {
        return $this->sourceRepository->index();
    }
    public function create()
    {
        return $this->sourceRepository->create();
    }
    public function store(SourceRequest $data)
    {
        return $this->sourceRepository->store($data);
    }

    public function delete(Request $request)
    {
        return  $this->sourceRepository->delete($request);
    }


    public function edit(Request $request)
    {
        return  $this->sourceRepository->edit($request->id);
    }


    public function update(SourceRequest $data)
    {
        return  $this->sourceRepository->update($data);
    }
}
