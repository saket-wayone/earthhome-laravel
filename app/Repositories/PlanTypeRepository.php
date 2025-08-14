<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Repositories\PlanType\PlanTypeInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PlanTypeRepository implements PlanTypeInterface
{
    public function index()
    {
        $data['plantype'] = Plan::orderby('id', 'desc')->get();
        return   view('admin.users.roles.list', $data);
    }

    public function create()
    {
        return  view('admin.users.roles.create');
    }
    public function store($data)
    {

        $query =  Plan::insert(['name' => $data['name'], 'created_at' => now()]);

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Role has been added']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  Plan::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  Plan::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  Plan::where('id', $data['id'])->delete();
        }
    }


    public  function edit($data): View
    {
        $price['plantype'] =  Plan::editfunction($data);
        return view('admin.users.roles.edit', $price);
    }

    public function update($data):JsonResponse
    {
         $savedata['name'] = $data['name'];
        $query = Plan::where('id', $data['id'])->update($savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Role has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }
}
