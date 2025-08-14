<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\StatusModel;
use App\Repositories\Status\StatusInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class StatusRepository implements StatusInterface
{
    public function index()
    {
        $data['status'] = StatusModel::orderby('id', 'desc')->get();
        return   view('admin.status.list', $data);
    }

    public function create()
    {
        return  view('admin.status.create');
    }
    public function store($data)
    {

        $query =  StatusModel::insert(['status' => ucfirst($data['status']), 'created_at' => now()]);

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Status has been added']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  StatusModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  StatusModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  StatusModel::where('id', $data['id'])->delete();
        }
    }


    public  function edit($data): View
    {
        $status['status'] =  StatusModel::editfunction($data);
        return view('admin.status.edit', $status);
    }

    public function update($data):JsonResponse
    {
         $savedata['status'] = $data['status'];
        $query = StatusModel::where('id', $data['id'])->update($savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Status has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }
}
