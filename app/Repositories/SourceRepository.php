<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\SourceModel;
use App\Repositories\Source\SourceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class SourceRepository implements SourceInterface
{
    public function index()
    {
        $data['source'] = SourceModel::orderby('id', 'desc')->get();
        return   view('admin.source.list', $data);
    }

    public function create()
    {
       
        return  view('admin.source.create');
    }
    public function store($data)
    {



        if (isset($data['image']) && $data['image']->isValid()) {
            // Store the image in the 'category' folder inside 'public'
            $imageName = time() . '_' . $data['image']->getClientOriginalName();

            // Move the image to the 'public/category' directory
            $data['image']->move(public_path('category'), $imageName);

            // Set the image path
            $imagePath = 'category/' . $imageName;
        } else {
            $imagePath = '';
            return response()->json(['code' => 400, 'message' => 'Invalid Image']);
        }
        $query =  SourceModel::insert(['source' => ucfirst($data['source']), 'created_at' => now() ,'image'=> $imagePath]);

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Category has been added']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  SourceModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  SourceModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  SourceModel::where('id', $data['id'])->delete();
        }
    }


    public  function edit($data): View
    {
        $status['source'] =  SourceModel::editfunction($data);
        return view('admin.source.edit', $status);
    }

    public function update($data):JsonResponse
    {
        if(isset($data['image']) && $data['image']->isValid()){
            $imageName = time() . '_' . $data['image']->getClientOriginalName();
            $data['image']->move(public_path('category'),$imageName);
            $imagePath = 'category/' . $imageName;

            $savedata['image']=$imagePath;
        }else{
            $imagePath = '';
            return response()->json(['code' => 400, 'message' => 'Invalid Image']);
        }
         $savedata['source'] = $data['source'];
        $query = SourceModel::where('id', $data['id'])->update($savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Source has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }
}
