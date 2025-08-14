<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\PriceModel;
use App\Repositories\Price\PriceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PriceRepository implements PriceInterface
{
    public function index(): View
    {
        $data['prices'] = PriceModel::orderby('id', 'desc')->get();
        return view('admin.prices.list', $data);
    }
    public function create(): View
    {
        $data['plans'] = Plan::orderby('id', 'asc')->get();

        return view('admin.prices.add',$data);
    }
    public function store($data)
    {
        $savedata['type'] = $data['type'];
        $savedata['price'] = $data['price'];
        $savedata['created_at'] = now();
        $query = PriceModel::insert($savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Price has been created succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
        return view('admin.prices.add');
    }



    public  function edit($data) : View
    {
        $price['plans'] = Plan::orderby('id', 'asc')->get();
         $price['prices'] =  PriceModel::editfunction($data);
        return view('admin.prices.edit', $price);
    }

    public function update($data) :JsonResponse
    {
        $savedata['type'] = $data['type'];
        $savedata['price'] = $data['price'];
        $query = PriceModel::where('id',$data['id'])->update($savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Price has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public  function delete($data){
        $type = $data['type'];
        if( $type =='activate'){
            return  PriceModel::where('id',$data['id'])->update(['flag'=>1]);

        }
        if( $type =='deactivate'){
            return  PriceModel::where('id',$data['id'])->update(['flag'=>0]);

        }

        if( $type == 'remove'){
            return  PriceModel::where('id',$data['id'])->delete();
  
        }



    }
}
