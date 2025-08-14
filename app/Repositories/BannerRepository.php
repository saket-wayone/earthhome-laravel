<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\BannerModel;
use App\Repositories\Banner\BannerInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class BannerRepository implements BannerInterface
{
    public function index()
    {
        $data['source'] = BannerModel::orderby('id', 'desc')->get();
        return   view('admin.banner.list', $data);
    }

    public function create()
    {
       
        return  view('admin.banner.create');
    }
    public function store($data)
    {



        if (isset($data['image']) && $data['image']->isValid()) {
            // Store the image in the 'banners' folder inside 'public'
            $imageName = time() . '_' . $data['image']->getClientOriginalName();

            // Move the image to the 'public/banners' directory
            $data['image']->move(public_path('banners'), $imageName);

            // Set the image path
            $imagePath = 'banners/' . $imageName;
        } else {
            $imagePath = '';
            return response()->json(['code' => 400, 'message' => 'Invalid Image']);
        }
        $query =  BannerModel::insert(['source' => ucfirst($data['source']), 'created_at' => now() ,'image'=> $imagePath]);

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Banner has been added']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  BannerModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  BannerModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  BannerModel::where('id', $data['id'])->delete();
        }
    }


    public  function edit($data): View
    {
        $status['source'] =  BannerModel::editfunction($data);
        return view('admin.banner.edit', $status);
    }

    public function update($data):JsonResponse
    {
        if(isset($data['image']) && $data['image']->isValid()){
            $imageName = time() . '_' . $data['image']->getClientOriginalName();
            $data['image']->move(public_path('banners'),$imageName);
            $imagePath = 'banners/' . $imageName;

            $savedata['image']=$imagePath;
        }else{
            $imagePath = '';
            return response()->json(['code' => 400, 'message' => 'Invalid Image']);
        }
         $savedata['source'] = $data['source'];
        $query = BannerModel::where('id', $data['id'])->update($savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Banner has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }
}
