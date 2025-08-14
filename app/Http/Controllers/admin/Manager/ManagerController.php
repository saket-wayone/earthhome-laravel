<?php

namespace App\Http\Controllers\admin\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerValidate;
use App\Models\User;
use App\Repositories\Manager\ManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    protected $ManagerInterface;
    public function __construct(ManagerInterface $ManagerInterface)
    {
        $this->ManagerInterface =  $ManagerInterface;
    }

    public function index()
    {
        return $this->ManagerInterface->index();
    }
    public function create()
    {
        return $this->ManagerInterface->create();
    }
    public function store(ManagerValidate $managervalidate)
    {
        return $this->ManagerInterface->store($managervalidate);
    }

    public function delete(Request $request)
    {
        return  $this->ManagerInterface->delete($request);
    }


    public function edit(Request $request)
    {
        return  $this->ManagerInterface->edit($request->id);
    }
    public function update(ManagerValidate $managervalidate)
    {
        return  $this->ManagerInterface->update($managervalidate);
    }
    public function uploadlogo(Request $request)
    {

        if ($request->hasFile('fileToUpload')) {
            // Get file
            $file = $request->file('fileToUpload');


            // Define custom file name
             $role  = Auth::user()->role;
             $companyname  = Auth::user()->company_name;
          
            $imageName = time() . '.webp';
            $file->move(public_path('uploads/' . $companyname), $imageName);
            $data['logo'] =  "uploads/$companyname/$imageName";

           $update=  User::where('id',Auth::user()->id)->update($data);
           if($update){
                return response()->json(['code'=>200, 'url' => url($data['logo'] )]);
           }else{
                return response()->json(['code'=>400,'url'=>'']);

           }


            // Insert file path into the database
            // $result = DB::table('images')->insert([
            //     'path' => $filePath,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);

            // if ($result) {
            //     return response()->json(['message' => 'Image uploaded successfully']);
            // } else {
            //     return response()->json(['message' => 'Failed to upload image'], 500);
            // }
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
        return $request->all();
    }
}
