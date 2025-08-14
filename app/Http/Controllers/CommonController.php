<?php

namespace App\Http\Controllers;

use App\Models\CommanModel;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    
    public function index(){
        $data['note']= CommanModel::latest()->first();
        return view('admin.common',$data);
    }
    public function store(Request $request)
    {

        CommanModel::truncate();
        $query = CommanModel::updateOrInsert(
            ['note' => ucfirst($request->post('note'))], // Condition to check
            ['created_at' => now()] // Fields to update or insert
        );

        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Note has been added']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something Went wrong!']);
        }
    }
}
