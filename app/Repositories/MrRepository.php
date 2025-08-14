<?php

namespace App\Repositories;

use App\Models\AllotManager;
use App\Models\CoupenModel;
use App\Models\PriceModel;
use App\Models\PrimaryPlan;
use App\Models\PurchasedPlan;
use App\Models\User;
use App\Repositories\Mr\MrInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MrRepository implements MrInterface
{
    public function index()
    {

        //makeun paused


        $get =  User::where('paused_till', '<=', now())->get();

        if (!empty($get)) {
            foreach ($get as $listing) {
                User::where('id', $listing->id)->update(['is_paused' => 0, 'paused_till' => null]);
            }
        }




        if (Auth::user()->role == 'company_admin') {
            $data['mrlist'] = User::join('purchasedcredits', 'purchasedcredits.alloted_user_id', 'users.id')->where('purchasedcredits.company_id', Auth::user()->id)->select('users.*', 'purchasedcredits.expiry_date', 'purchasedcredits.unique_code')->get();
        }



        if (Auth::user()->role == 'manager') {
            $data['mrlist'] = User::join('purchasedcredits', 'purchasedcredits.alloted_user_id', 'users.id')->where('users.add_by', Auth::user()->id)->select('users.*', 'purchasedcredits.expiry_date', 'purchasedcredits.unique_code')->get();
        }

        return view('admin.mr.list', $data);
    }
    public function history()
    {
        // get the company primary plans
        $data['primaryplans'] = $gettotalquantiy =  PrimaryPlan::with('Companies')->where('company_id', Auth::user()->id)->orderby('id', 'desc')->get();
        $data['total'] = $gettotalquantiy->sum('quantity');

        $data['leftlicense'] =  PurchasedPlan::where('company_id', Auth::user()->id)->where('alloted_user_id', null)->count();

        $data['prices'] = PriceModel::all();
        return view('admin.mr.history', $data);
    }
    public function create(): View
    {
        $data['manager'] = User::getCompaniesUser('company_id', Auth::user()->id, 'manager');

        if (Auth::user()->role === 'admin') {
            $total  = 1;
        }

        if (Auth::user()->role === 'company_admin' || Auth::user()->role  == 'manager') {
            // Check the total credit purchased
            $total = PrimaryPlan::where('company_id', Auth::user()->id)->sum('quantity');
            if (Auth::user()->role == 'manager') {
                $total = PrimaryPlan::where('company_id', Auth::user()->company_id)->sum('quantity');
            }
        }

        $data['total'] = $total;

        return view('admin.mr.create', $data);
    }
    public function license()
    {
        $data['purchasedplan'] =  PurchasedPlan::where('company_id', Auth::user()->id)->orderby('id', 'desc')->get();
        $data['monthly'] =  PurchasedPlan::join('primaryplans', 'primaryplans.id', 'purchasedcredits.plan_id')->where('purchasedcredits.company_id', Auth::user()->id)->where('primaryplans.type', 'Monthly')->orderby('purchasedcredits.id', 'desc')->select('purchasedcredits.*')->get();
        $data['halfyearly'] =  PurchasedPlan::join('primaryplans', 'primaryplans.id', 'purchasedcredits.plan_id')->where('purchasedcredits.company_id', Auth::user()->id)->where('primaryplans.type', 'Half Yearly')->select('purchasedcredits.*')->orderby('purchasedcredits.id', 'desc')->get();
        $data['annual'] =  PurchasedPlan::join('primaryplans', 'primaryplans.id', 'purchasedcredits.plan_id')->where('purchasedcredits.company_id', Auth::user()->id)->where('primaryplans.type', 'Annual')->select('purchasedcredits.*')->orderby('purchasedcredits.id', 'desc')->get();
        //  $data['monthly'] =  PurchasedPlan::join('primaryplans','primaryplans.id','purchasedcredits.plan_id')->where('purchasedcredits.company_id', Auth::user()->id)->where('primaryplans.type','Monthly')->orderby('purchasedcredits.id', 'desc')->get();
        //  $data['halfyearly'] =  PurchasedPlan::where('company_id', Auth::user()->id)->where('type','Half Yearly')->orderby('id', 'desc')->get();
        //  $data['annual'] =  PurchasedPlan::where('company_id', Auth::user()->id)->where('type','Annual')->orderby('id', 'desc')->get();





        return view('admin.mr.license', $data);
    }
    public function notused()
    {
        $data['purchasedplan'] =  PurchasedPlan::where('company_id', Auth::user()->id)->where('alloted_user_id', null)->orderby('id', 'desc')->get();
        return view('admin.mr.license', $data);
    }
    public function purchasecredit($data)
    {


        // step 1 get the current login company name with two digit  name
        $companyname =  substr(Auth::user()->company_name, 0, 2);

        $data1['type'] =  $data['plan_type'];
        $data1['created_at'] = now();
        $data1['coupen']  =  $data['coupenid'];

        if ($data['coupenid'] != '') {
            // then update the usage 
            $usagenumber =   CoupenModel::where('coupen_code', $data['coupenid'])->first();
            $latestused  = $usagenumber->used + 1;
            CoupenModel::where('coupen_code', $data['coupenid'])->update(['used' => $latestused]);
        }

        //  calculate the expiry date
        if ($data['plan_type'] == 'Monthly') {
            $data1['expiry_date'] = $expirydate =  Carbon::now()->addMonth(); // Add one month from current date
        }

        if ($data['plan_type'] == 'Half Yearly') {
            $data1['expiry_date'] = $expirydate =  Carbon::now()->addMonths(6); // Add 6 months from current date
        }

        if ($data['plan_type'] == 'Annual') {
            $data1['expiry_date'] = $expirydate =  Carbon::now()->addYear(); // Add one year from current date
        }
        $data1['quantity'] =  $data['quantity'];
        $data1['totalamount'] =  $data['totalmoneyform'];
        $data1['company_id'] = $cid = Auth::user()->id;
        $insertedId =    PrimaryPlan::insertGetId($data1);
        // step 2 get the quantity of the user and loop the things
        for ($i = 1; $i <= $data1['quantity']; $i++) {
            // Initialize purchasedPlan array
            $purchasedPlan = [];

            // Fetch the last inserted record
            $lastRecord = PurchasedPlan::where('company_id', Auth::user()->id)->orderby('id', 'desc')->first();

            if (!empty($lastRecord)) {
                $integerPart = preg_replace('/[^0-9]/', '', $lastRecord->unique_code);
                $newvalue = $integerPart + 1;
                $purchasedPlan['unique_code'] = $companyname . $newvalue;
            } else {
                $purchasedPlan['unique_code'] = $companyname . '1';
            }

            $purchasedPlan['company_id'] = $cid;
            $purchasedPlan['plan_id'] = $insertedId;
            $purchasedPlan['expiry_date'] = $expirydate;
            $purchasedPlan['created_at'] = now();

            // Insert the record
            PurchasedPlan::insert($purchasedPlan);
        }
        return back()->with('message', 'Congratulations! You  have purchased the license');
    }
    public function renewupdate($data)
    {


        // step 1 get the current login company name with two digit  name
        $companyname =  substr(Auth::user()->company_name, 0, 2);

         $data1['type'] =  $data['plan_type'];
        $data1['updated_at'] = now();
        $data1['coupen']  =  $data['coupenid'];

        if ($data['coupenid'] != '') {
            // then update the usage 
            $usagenumber =   CoupenModel::where('coupen_code', $data['coupenid'])->first();
            $latestused  = $usagenumber->used + 1;
            CoupenModel::where('coupen_code', $data['coupenid'])->update(['used' => $latestused]);
        }


        $currenplans =  Session::get('ids');
        // now looping all the things

        foreach ($currenplans as $showlist) {
            $date =    PurchasedPlan::where('id', $showlist)->first();


            //  calculate the expiry date
            if (Session::get('type') == 'Monthly') {
                $data1['expiry_date'] = $expirydate =  Carbon::parse($date->expiry_date)->addMonth(); // Add one month from current date
            }

            if (Session::get('type') == 'Half Yearly') {
                $data1['expiry_date'] = $expirydate =  Carbon::parse($date->expiry_date)->addMonths(6); // Add 6 months from current date
            }

            if (Session::get('type') == 'Annual') {
                $data1['expiry_date'] = $expirydate =   Carbon::parse($date->expiry_date)->addYear(); // Add one year from current date
            }


            PurchasedPlan::where('id',$showlist)->update(['expiry_date'=>$expirydate,'updated_at'=>now()]);
        }

    
        return back()->with('message', 'Congratulations! You  have renewed the license');
    }

    public function chhosedplan($request)
    {
        // check if the coupen exist \
        $postamount = $request['amount'];
        $fetchecd = CoupenModel::where('coupen_code', $request['couponCode'])->first();
        if (!empty($fetchecd)) {

            // check  like if user used all coupen 
            if ($fetchecd->used >= $fetchecd->usage) {
                return response()->json(['code' => 401, 'message' => 'All Coupon has been used']);
            }



            // check if the coupen is valid or not
            if (date('Y-m-d') >  $fetchecd->valid_upto) {
                return response()->json(['code' => 401, 'message' => 'Coupon has been expired!']);
            } else {
                // fetched the discount 
                $discountamoint = $postamount * ($fetchecd->percentage / 100);
                $amountopay = $postamount  -  $discountamoint;

                return response()->json(['code' => 200, 'message' => 'Coupon Applied!', 'amount' => ceil($amountopay), 'discountamount' => ceil($discountamoint)]);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'Coupon Not Found!']);
        }




        // $data['choosedplan']= PriceModel::where('id',$id)->first();
        // return view('admin.mr.choosed',$data);

        // return $id;
    }

    public function companychhosedplan($id)
    {
        $data['choosedplan'] = PriceModel::where('id', $id)->first();

        return view('admin.mr.choosedplan', $data);
    }

    public function pausedmr($data)
    {
        $plans =   PurchasedPlan::where('alloted_user_id', $data['mr_id'])->first();

        $expiryDate = Carbon::parse($plans->expiry_date)->addDays($data['days']);
        $puasedtill =  Carbon::now()->addDays($data['days']);

        // check if the current expiry is still grater than the new days
        if ($plans->expiry_date  <  $puasedtill) {
            return response()->json(['code' => 401, 'message' => 'Your license will be expired on ' . date('Y-m-d', strtotime($plans->expiry_date))]);
        } else {

            // Now update user
            $qe = User::where('id', $data['mr_id'])->update(['is_paused' => 1, 'paused_till' => $puasedtill]);

            $qe1 =  PurchasedPlan::where('alloted_user_id', $data['mr_id'])->update(['expiry_date' => $expiryDate]);

            if ($qe && $qe1) {
                return response()->json(['code' => 202, 'message' => 'Mr Paused sussfully']);
            } else {
                return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function paused($id)
    {
        $data['mrinfo']  = User::where('id', $id)->first();
        return view('admin.mr.paused', $data);
    }
    public function edit($id)
    {


        $data['manager'] = User::getCompaniesUser('company_id', Auth::user()->id, 'manager');
        $data['mrinfo']  = User::where('id', $id)->first();
        return view('admin.mr.edit', $data);
    }


    public function update($data)
    {


        $filteredData = Arr::except($data['mrdata'], ['_token', 'manager_id', 'password']);


        // check email unquenesss 
        $existemail =    User::where('email', $data['mrdata']['email'])->where('id', '!=', $data['id'])->exists();

        if ($existemail) {
            return response()->json(['code' => 405, 'message' => 'Email Already taken!']);
        } else {
            $update = User::where('id', $data['id'])->update($filteredData);
            if ($update) {

                // check if the request has password which is not null then  update password too
                if ($data['mrdata']['password'] != '') {
                    // hashed password
                    $hashedpassword =  Hash::make($data['mrdata']['password']);
                    User::where('id', $data['id'])->update(['password' => $hashedpassword]);
                }
                $postManagerId = $data['mrdata']['manager_id'];

                if ($postManagerId != '') {

                    // check if already assign the manager if alloted then update elese insert
                    $llotedmanager =   AllotManager::where('mr_id', $data['id'])->first();

                    if (!empty($llotedmanager)) {

                        // update
                        AllotManager::where('mr_id', $data['id'])->update(['manager_id' => $postManagerId]);
                    } else {
                        AllotManager::insert(['mr_id' => $data['id'], 'manager_id' => $postManagerId, 'created_at' => now()]);
                    }
                }
                return response()->json(['code' => 200, 'message' => 'Mr Edit successfully!']);
            } else {
                return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function renew($data)
    {
        // get the price of the plan
        $planinfo = $data['choosedplan'] =  PriceModel::where('type', $data['type'])->first();
        $data['totalamount'] = $planinfo->price * count($data['ids']);
        $data['selectedplans'] = count($data['ids']);


        return view('admin.mr.renew', $data);
    }
}
