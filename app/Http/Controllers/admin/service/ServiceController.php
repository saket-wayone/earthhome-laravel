<?php

namespace App\Http\Controllers\admin\service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServceAggrementRequest;
use App\Models\ServiceModel;
use App\Repositories\Service\ServiceInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceInterface;

    public function __construct(ServiceInterface $serviceInterface)
    {
        $this->serviceInterface  = $serviceInterface;
    }

    public function index()
    {
        return  $this->serviceInterface->index();
    }
    public function viewscore(Request $request)
    {
        return  $this->serviceInterface->viewscore($request->id);
    }
    public function expired()
    {
        return  $this->serviceInterface->expired();
    }
    public function edit(Request $request)
    {
        
        return  $this->serviceInterface->edit($request->id);
    }

    public function create(Request $request)
    {
        return  $this->serviceInterface->create($request->id);
    }
    public function store(ServceAggrementRequest $servicegrement)
    {
        return  $this->serviceInterface->store($servicegrement);

    }
  
  
  public function update(Request $request)
    {
        return  $this->serviceInterface->update($request->all());

    }
  
   
    public function delete(Request $request)
    {
       return  $this->serviceInterface->delete($request);
    }
    public function deleteserviceagreement(Request $request)
    {
       return  $this->serviceInterface->deleteserviceagreement($request);
    }
    public function score(Request $request)
    {
       return  $this->serviceInterface->score($request);
    }

    
    public function viewserviceaggrement(Request $request)
    {
       return  $this->serviceInterface->viewserviceaggrement($request);
    }



   
}
