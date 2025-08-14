<?php 
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Manager\ManagerInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ManagerRepository implements ManagerInterface
{
    public function index():View
    {
        $data['managers']=User::where('company_id',Auth::user()->id)->where('role','manager')->get();
        return view('admin.managers.list',$data);
    }
    public function create():View
    {
        return view('admin.managers.create');
    }

    public  function delete($data){
        $type = $data['type'];
        if( $type =='activate'){
            return  User::where('id',$data['id'])->update(['flag'=>1]);

        }
        if( $type =='deactivate'){
            return  User::where('id',$data['id'])->update(['flag'=>0]);

        }

        if( $type == 'remove'){
            return  User::where('id',$data['id'])->delete();
  
        }



    }

    public  function edit($data): View
    {
       $user['user']=  User::editfunction($data);
       return view('admin.managers.edit',$user);
    }
    
    public function store($data)
    {
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $data1['name'] =  $data['name'];
        $data1['email'] =  $data['email'];
        $data1['password'] = $hashedPassword;
        $data1['work_area'] = $data['work_area'];
        $data1['phone'] =  $data['phone'];
        $data1['company_id'] =Auth::user()->id;
        $data1['role'] =  $data['role'];
        $data1['can_create_mr'] = isset($data['can_create_mr'])   ? 1  :  0;
        $data1['can_create_books'] = isset($data['can_create_book']) ? 1  : 0;
        $data1['flag'] =  1;
        $data1['created_at'] = now();

        $query = User::insert($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' => $data['role'] . ' has been created succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public function update($data)
    {
        $data1['name'] =  $data['name'];
        $data1['email'] =  $data['email'];
        $data1['work_area'] = $data['work_area'];
        $data1['phone'] =  $data['phone'];
        $data1['company_id'] =Auth::user()->id;
        $data1['role'] =  $data['role'];
        $data1['can_create_mr'] = isset($data['can_create_mr'])   ? 1  :  0;
        $data1['can_create_books'] = isset($data['can_create_book']) ? 1  : 0;
        $data1['flag'] =  1;
        $data1['created_at'] = now();
        $query = User::where('id',$data['user_id'])->update($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' => $data['role'] . ' has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

}

?>