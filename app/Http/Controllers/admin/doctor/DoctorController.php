<?php

namespace App\Http\Controllers\admin\doctor;

use App\Http\Controllers\Controller;
use App\Models\admin\doctor\DoctorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DoctorController extends Controller
{
    public function index()
    {
        $data['doctor'] = DoctorModel::where('flag','!=','2')->orderBy('id', 'desc')->cursor();
        return view('admin.doctor.list',$data);
    }

    public function add()
    {

        return view('admin.doctor.create');
    }

    public function store(Request $request)
    {

        $rules = [
            'doctor_name' => 'required|string|max:200|regex:/^[a-zA-Z\s]+$/',
            'specialty' => 'required|string|max:200|regex:/^[a-zA-Z\s]+$/',
            'clinic_1_address_timings' => 'required|max:300',
            'contact_number' => 'numeric|digits:10',
            
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            $data['doctor_name']                = $request->doctor_name;
            $data['specialty']                  = $request->specialty;
            $data['contact_number']             = $request->contact_number;
            $data['email']                      = $request->email;
            $data['clinic_1_address_timings']   = $request->clinic_1_address_timings;
            $data['clinic_2_address_timings']   = $request->clinic_1_address_timings;
            $data['clinic_3_address_timings']   = $request->clinic_1_address_timings;
            $data['clinic_4_address_timings']   = $request->clinic_1_address_timings;
            $data['anniversary']                = $request->anniversary;
            $data['dob']                        = $request->dob;



            $inserteddata = DoctorModel::insert($data);
            
            if($inserteddata){
                return response()->json([ 'code' => 200, 'message' => 'Added Successfully.']);
            } else {
                return response()->json(['code' => 201, 'message' => 'Something went wrong']);
            }
            

        }
    }

    public function edit(Request $request){

        $data['edit'] = DoctorModel::where('id',$request->id)->first();
        return view('admin.doctor.edit',$data);
    }

    public function update(Request $request){
        
        $rules = [
            'doctor_name' => 'required|string|max:200|regex:/^[a-zA-Z\s]+$/',
            'specialty' => 'required|string|max:200|regex:/^[a-zA-Z\s]+$/',
            'clinic_1_address_timings' => 'required|max:300',
            'contact_number' => 'numeric|digits:10',
            
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            $data['doctor_name']                = $request->doctor_name;
            $data['specialty']                  = $request->specialty;
            $data['contact_number']             = $request->contact_number;
            $data['email']                      = $request->email;
            $data['clinic_1_address_timings']   = $request->clinic_1_address_timings;
            $data['clinic_2_address_timings']   = $request->clinic_2_address_timings;
            $data['clinic_3_address_timings']   = $request->clinic_3_address_timings;
            $data['clinic_4_address_timings']   = $request->clinic_4_address_timings;
            $data['anniversary']                = $request->anniversary;
            $data['dob']                        = $request->dob;



            $inserteddata = DoctorModel::where('id',$request->id)->update($data);
            
            if($inserteddata){
                return response()->json([ 'code' => 200, 'message' => 'Update Successfully.']);
            } else {
                return response()->json(['code' => 201, 'message' => 'Something went wrong']);
            }
            

        }
    }

    public  function delete(Request $request){
        $type = $request->type;
       
        if( $type =='remove'){
            return  DoctorModel::where('id',$request->id)->update(['flag'=>2]);

        }

     


    }

    public function importexcel()
    {
        $data = Excel::toArray([], request()->file('file'));
        if (!empty($data)) {
            foreach ($data[0] as $key => $row) {
                if ($key >= 1) {
                    if (!empty($row['0'])) {
                        $savedata['doctor_name'] = $row[0] ?? '';
                        $savedata['specialty'] = $row[1] ?? '';
                        $savedata['contact_number'] = $row[2] ?? '';
                        $savedata['email'] = $row[3] ?? '';
                        $savedata['anniversary'] = $row[4] ?? '';
                        $savedata['dob'] = $row[5] ?? '';
                        $savedata['clinic_1_address_timings'] = $row[6] ?? '';
                         $savedata['clinic_2_address_timings'] = $row[7] ?? '';
                          $savedata['clinic_3_address_timings'] = $row[8] ?? '';
                           $savedata['clinic_4_address_timings'] = $row[9] ?? '';
                       

                        $saved = DoctorModel::insert($savedata);
                    }
                }
            }
        }

        if (!empty($saved)) {
            return response()->json(['code' => 200, 'message' =>  'Imported successfully']);
        } else {
            return response()->json(['code' => 400, 'message' =>  'Something went wrong']);
        }
    }

}
