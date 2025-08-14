<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    public function index(Request $request)
    {
        return  $this->userInterface->index($request);
    }
    public function all(Request $request)
    {
        return  $this->userInterface->all($request);
    }
    public function create()
    {
        return  $this->userInterface->create();
    }
    public function store(UserCreateRequest $request)
    {
        return  $this->userInterface->store($request->all());
    }
    public function delete(Request $request)
    {
        return  $this->userInterface->delete($request);
    }
    public function edit(Request $request)
    {
        return  $this->userInterface->edit($request->id);
    }
    public function update(UserCreateRequest $request)
    {
        return  $this->userInterface->update($request);
    }
    public function status(Request $request)
    {
        return  $this->userInterface->statusmethod($request->status);
    }

    public function viewmr($id)
    {

        return  $this->userInterface->viewmr($id);
    }
    public function changepassword()
    {

        return  $this->userInterface->changepassword();
    }

    public static function update_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6'
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            $exist = User::where('id', Auth::user()->id)->first();

            if (Hash::check($request->current_password, $exist->password)) {

                if ($request->new_password == $request->confirm_password) {

                    $savedata['password'] = Hash::make($request->new_password);
                    $id = Auth::user()->id;

                    $query = User::where('id', $id)->update($savedata);

                    if ($query) {
                        return response()->json(['code' => 200, 'message' => 'Password Updated Successfully']);
                    } else {
                        return response()->json(['code' => 400, 'message' => 'Something went wrong']);
                    }
                } else {
                    return response()->json(['code' => 400, 'message' => 'Password & Confirm Password must be same']);
                }
            } else {
                return response()->json(['code' => 400, 'message' => 'Current password is wrong!']);
            }
        }
    }

    public static function changepassworddiv($id, $table)
    {
        $data['id'] = $id;
        $data['table'] = $table;
        return view('admin.users.change_password', $data);
    }

    public static function updatepassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'rowid' => 'required',
            'table' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            if ($request->new_password == $request->confirm_password) {

                $savedata['password'] = Hash::make($request->new_password);
                $query = DB::table($request->table)->where('id', $request->rowid)->update($savedata);

                if ($query) {
                    return response()->json(['code' => 200, 'message' => 'Password Changed Successfully']);
                } else {
                    return response()->json(['code' => 400, 'message' => 'Something went wrong']);
                }
            } else {
                return response()->json(['code' => 400, 'message' => 'Password & Confirm Password must be same']);
            }
        }
    }
    


    public function team()
    {
        return  $this->userInterface->myteam();
    }
}
