<?php

namespace App\Repositories;

use App\Models\CoupenModel;
use App\Repositories\Coupen\CoupenInterface;

class CoupenRepository implements CoupenInterface
{
    public  function index()
    {
        $data['coupen'] = CoupenModel::orderby('id', 'desc')->get();
        return   view('admin.coupen.list', $data);
    }
    public  function create()
    {
        return   view('admin.coupen.add');
    }

    public function edit($id)
    {
        $data['coupen'] =  CoupenModel::where('id', $id)->first();
        return view('admin.coupen.edit', $data);
    }
    public function store($data)
    {
        $coupen['coupen_code'] = $data['coupen_code'];
        $coupen['percentage'] = $data['discount'];
        $coupen['valid_upto'] = $data['valid_upto'];
        $coupen['usage'] = $data['usage'];
        $coupen['created_at'] = now();
        $query =  CoupenModel::insert($coupen);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Coupen  has been created succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  CoupenModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  CoupenModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  CoupenModel::where('id', $data['id'])->delete();
        }
    }

    public  function update($data){

        $coupen['coupen_code'] = $data['coupen_code'];
        $coupen['percentage'] = $data['discount'];
        $coupen['updated_at'] = now();
                $coupen['usage'] = $data['usage'];

        $coupen['valid_upto'] = $data['valid_upto'];

        $query =  CoupenModel::where('id',$data['id'])->update($coupen);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Coupen  has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }

    }

    public function applycoupen($request){
        return $request;
    }
}
