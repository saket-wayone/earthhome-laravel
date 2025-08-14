<?php

namespace App\Http\Controllers\admin\firms;

use App\Http\Controllers\Controller;
use App\Http\Requests\firmRequest;
use App\Repositories\Firms\FirmInterface;
use Illuminate\Http\Request;
use App\Models\Firm;

class FirmController extends Controller
{
    
    protected $firmintrface;
    public function __construct(FirmInterface  $firmintrface)
    {
         $this->firmintrface =  $firmintrface;
    }
    public function index(){
        return $this->firmintrface->index();
    }

    public function create(){
        return $this->firmintrface->create();
    }
    public function edit($id){
        return $this->firmintrface->edit($id);
    }

    public function store(firmRequest $request){
        
        $data1['name'] =  ucfirst($request->name);
        $data1['address'] = $request->address;
        $data1['gst'] = $request->gst;
        $data1['phone'] = $request->phone;
        $data1['created_at'] =  now();
        
        if ($request->hasFile('logo')) {
    $file = $request->file('logo');
    $fileName = time() . '_' . $file->getClientOriginalName();
    
    // Manually define the correct path based on your directory structure
    // return $destinationPath = base_path('public_html/uploads/proofs');
    $destinationPath = '/home/u239133126/domains/kapilandsons.com/public_html/uploads/logo';
    
    // Ensure the destination folder exists
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }
    
    // Move the file to the specified destination
    $file->move($destinationPath, $fileName);
    
    // Save the file path to the database (relative to the public directory)
     $data1['logo'] = 'uploads/logo/' . $fileName;
}
        $query =  Firm::insert($data1);

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Firms has been added']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
        // return $this->firmintrface->store($request->all());
    }


    public function destroy(Request $request){
        return $this->firmintrface->delete($request->all());
    }
    public function updatefirm(Request $request){
         
        $data1['name'] =  ucfirst($request->name);
        $data1['address'] = $request->address;
        $data1['gst'] = $request->gst;
        $data1['phone'] = $request->phone;
        $data1['created_at'] =  now();
        
        if ($request->hasFile('logo')) {
    $file = $request->file('logo');
    $fileName = time() . '_' . $file->getClientOriginalName();
    
    // Manually define the correct path based on your directory structure
    // return $destinationPath = base_path('public_html/uploads/proofs');
    $destinationPath = '/home/u239133126/domains/kapilandsons.com/public_html/uploads/logo';
    
    // Ensure the destination folder exists
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }
    
    // Move the file to the specified destination
    $file->move($destinationPath, $fileName);
    
    // Save the file path to the database (relative to the public directory)
     $data1['logo'] = 'uploads/logo/' . $fileName;
}
        $query = Firm::where('id', $request->id)->update($data1);

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Firms has been updated successfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
        // return $this->firmintrface->store($request->all());
    
        
        // return $this->firmintrface->update($request->all());
    }
}
