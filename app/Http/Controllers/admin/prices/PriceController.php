<?php

namespace App\Http\Controllers\admin\prices;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Repositories\Price\PriceInterface;
use Illuminate\Http\Request;



class PriceController extends Controller
{
    protected $priceInterface;
    public function __construct(PriceInterface $priceInterface)
    {
        $this->priceInterface = $priceInterface;
    }

    public function index()
    {
        return $this->priceInterface->index();
    }
    public function create()
    {
        return $this->priceInterface->create();
    }
    public function store(PriceRequest $priceRequest)
    {
        return $this->priceInterface->store($priceRequest);
    }
    public function edit(Request $request)
    {
        return  $this->priceInterface->edit($request->id);
    }
    public function update(PriceRequest $priceRequest)
    {
        return  $this->priceInterface->update($priceRequest);
    }

    public function delete(Request $request)
    {
        return  $this->priceInterface->delete($request);
    }
    
}
