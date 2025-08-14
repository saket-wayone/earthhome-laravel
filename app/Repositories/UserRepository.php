<?php

namespace  App\Repositories;

use App\Models\AllotManager;
use App\Models\GlobalModel;
use App\Models\Plan;
use App\Models\PrimaryPlan;
use App\Models\PurchasedPlan;
use App\Models\User;
use App\Models\WorkUnder;
use App\Repositories\User\UserInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserRepository  implements UserInterface
{

    public function index($request)
    {
        $role =  Str::title($request['status']);
        if (Str::contains($role, '-')) {
            $role =  str_replace('-', ' ',  $role);
        }

        $data['users'] = User::getdata($role);
        $data['status'] =  'All Approved Users';
        return view('admin.users.list', $data);
    }
    public function all()
    {
        $data['users'] = User::whereNotIn('role', ['admin','agent'])->orderby('id','desc')->get();
        $data['status'] =  'All Approved Users';
        return view('admin.users.list', $data);
    }
    public function statusmethod($request)
    {
        if ($request == 'notapproved') {
            $flag = 0;
            $data['users'] = User::notapproved('admin', $flag);
            $data['status'] =  'Pending';
        }
        if ($request == 'approved') {
            $flag = 1;
            $data['users'] = User::notapproved('admin', $flag);
            $data['status'] =  'Approval Request Accepted';
        }
        return view('admin.users.list', $data);
    }
    public function create()
    {
        $data['roles'] = Plan::orderby('id', 'desc')->get();
        $data['manager'] = GlobalModel::getDataOrderByiDesc('users', 'role', 'Manager');

        return view('admin.users.create', $data);
    }

    public function store($data)
    {
         $data1['unique_id'] =GlobalModel::getlastGFCode('users');

        if ($data['role'] == 'company_admin') {
            $data1['company_name'] =  $data['company_name'] ?? '';
            $data1['gst'] =  $data['gst'] ?? '';
            $data1['registered_office'] =  $data['registered_office'] ?? '';
            $data1['license_cost'] =  $data['license_cost'] ?? '';
        }



        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $data1['name'] =  $data['name'] ?? '';
        $data1['email'] =  $data['email'] ?? '';
        $data1['password'] = $hashedPassword ?? '';
        $data1['phone'] =  $data['phone'] ?? '';
        $data1['dob'] =  $data['dob'] ?? '';
        $data1['joining_date'] =  $data['joining_date'] ?? '';
        $data1['registered_office'] =  $data['registered_office'] ?? ''; // this is address of employee


        $data1['role'] =  $data['role'] ?? '';
        $data1['flag'] =  1 ?? '';
        $data1['created_at'] = now();
        // check if the post role is mr 
        if ($data['role'] == 'mr') {
            $data1['work_area']  = $data['work_area'];
            if (Auth::user()->role == 'company_admin') {
                $cid =  Auth::user()->id;
            }
            if (Auth::user()->role == 'manager') {
                $cid =  Auth::user()->company_id;
                $data1['add_by'] =  Auth::user()->id;
                $data1['company_id'] = $cid;
            }
            $checkcount = PurchasedPlan::where('company_id', $cid)->whereNull('alloted_user_id')->count();
            if ($checkcount  == 0) {
                return response()->json(['code' => 407, 'message' => 'You have used all credits kindly purchase more license!']);
            }
        }

        $query = User::insertGetId($data1);

        // if ($data['workunder'] != '') {
        //     WorkUnder::insert(['user_id' => $query, 'manager_id' => $data['workunder'], 'created_at' => now()]);
        // }
        if ($query > 0) {
            if ($data['role'] == 'mr') {

                // if  manager_id is not  null 
                if ($data['manager_id'] != null) {
                    // then allot manager to the user
                    AllotManager::insert(['manager_id' => $data['manager_id'], 'mr_id' => $query, 'created_at' => now()]);
                }
                if (Auth::user()->role == 'manager') {
                    AllotManager::insert(['manager_id' => Auth::user()->id, 'mr_id' => $query, 'created_at' => now()]);
                }

                if (Auth::user()->role == 'manager') {
                    $checkallotment = PurchasedPlan::where('company_id', Auth::user()->company_id)->whereNull('alloted_user_id')->first();

                    if (!empty($checkallotment)) {
                        PurchasedPlan::where('id', $checkallotment->id)->update(['alloted_user_id' => $query, 'alloted_date' => now()]);
                    }
                }

                // if the  inserted role  is mr then allot the plan to the  mr
                $checkallotment = PurchasedPlan::where('company_id', Auth::user()->id)->whereNull('alloted_user_id')->first();

                if (!empty($checkallotment)) {
                    PurchasedPlan::where('id', $checkallotment->id)->update(['alloted_user_id' => $query, 'alloted_date' => now()]);
                }
            }


            return response()->json(['code' => 200, 'message' => $data['role'] . ' has been created succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  User::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  User::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  User::where('id', $data['id'])->delete();
        }

        if ($type == 'unpaused') {

            // check if the user  unpaused itself 

            // get the  plan id
            $getplanidAndExpiryDate =  PurchasedPlan::where('alloted_user_id', $data['id'])->first();
            $mainPlanExpiry = PrimaryPlan::where('id', $getplanidAndExpiryDate->plan_id)->first();
            $usrrinfo = User::where('id', $data['id'])->first();

            if (date('Y-m-d', strtotime($usrrinfo->paused_till) > date('Y-m-d'))) {
                User::where('id', $data['id'])->update(['is_paused' => 0, 'paused_till' => null]);
                PurchasedPlan::where('alloted_user_id', $data['id'])->update(['expiry_date' => $mainPlanExpiry->expiry_date]);
            }
        }
    }
    public  function edit($data): View
    {
        $user['user'] =  User::editfunction($data);
        $user['roles'] = Plan::orderby('id', 'desc')->get();
        $user['manager'] = GlobalModel::getDataOrderByiDesc('users', 'role', 'Manager');
        $user['allotedmanager'] = GlobalModel::getSingleData('workunder','user_id',$data);
         return view('admin.users.edit', $user);
    }

    public function update($data)
    {
        // $data1['company_name'] =  $data['company_name'];
        $data1['name'] =  $data['name'];
        $data1['email'] =  $data['email'];
        $data1['phone'] =  $data['phone'];
        $data1['role'] =  $data['role'];
        $data1['joining_date'] =  $data['joining_date'];
        $data1['created_at'] = now();
        $data1['dob'] =  $data['dob'] ?? '';
        if ($data['workunder'] != '') {
            WorkUnder::updateOrCreate(
                [
                    'user_id' => $data['user_id'], 
                    'manager_id' => $data['workunder']
                ],
                [
                    'created_at' => now()
                ]
            );
        }

        // $data1['gst'] =  $data['gst'];
        $data1['registered_office'] =  $data['registered_office'];
        $query = User::where('id', $data['user_id'])->update($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' => $data['role'] . ' has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public function viewmr($id)
    {
        $data['mrlist'] = User::join('purchasedcredits', 'purchasedcredits.alloted_user_id', 'users.id',)->where('purchasedcredits.company_id', $id)->select('users.*', 'purchasedcredits.unique_code', 'purchasedcredits.plan_id', 'purchasedcredits.alloted_date', 'purchasedcredits.expiry_date')->get();
        return view('admin.mr.company-mr-list', $data);
    }
    public function myteam()
    {
         $data['users'] =WorkUnder::join('users','users.id','workunder.user_id')->where('manager_id',Auth::user()->id)->where('users.flag',1)->where('workunder.user_id','!=',Auth::user()->id)->get();
         $data['status'] =  'My Team Members';

         return view('admin.users.list', $data);
    }

    public function changepassword(): View
    {
        return view('admin.changepassword');
    }
}
