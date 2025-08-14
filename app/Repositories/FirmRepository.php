<?php 
namespace App\Repositories;

use App\Models\Firm;
use App\Repositories\Firms\FirmInterface;

class FirmRepository  implements FirmInterface 
{
    public function index()
    {
        $data['status'] = Firm::orderby('id', 'desc')->get();
        return   view('admin.firms.list', $data);
    }

    public function create()
    {
        return  view('admin.firms.create');
    }
    public function store($data)
    {

        $data1['name'] =  ucfirst($data['name']);
        $data1['address'] = $data['address'];
        $data1['gst'] = $data['gst'];
        $data1['phone'] = $data['phone'];
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
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  Firm::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  Firm::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  Firm::where('id', $data['id'])->delete();
        }
    }


    public  function edit($data)    
    {
        $status['firms'] =  Firm::find($data);
        return view('admin.firms.edit', $status);
    }

    public function update($data)
    {
         $savedata['name'] = $data['name'];
         $savedata['address'] = $data['address'];
        $query = Firm::where('id', $data['id'])->update( $savedata);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Firm has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }
}


?>