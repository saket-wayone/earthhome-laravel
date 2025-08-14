<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookModel;
use App\Models\feedbaclModel;
use App\Models\Firm;
use App\Models\PurchasedPlan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\leadModel;
use App\Models\RiskModel;
use App\Models\ServiceModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
     // public function index()
     // {
     //      $data['company_admin'] =  User::where('role', '!=', 'admin')->count();
     //      $data['approved'] =  User::getcount('admin', 1);
     //      $data['notapproved'] =  User::getcount('admin', 0);
     //      $data['serviceaggrementexpiry'] = ServiceModel::whereDate('expirydate', '>', now())->groupBy('risk_id')->get(['risk_id'])->count();
     //      $data['serviceaggrementcount'] = ServiceModel::groupBy('risk_id')->get(['risk_id'])->count();
     //      $data['riskcount'] =  RiskModel::count();
     //      $data['mrcount'] = PurchasedPlan::where('company_id', Auth::user()->id)->where('alloted_user_id', '!=', null)->count();


     //      //  leads


     //      // handling count
     //      $allleads = leadModel::query();
     //      $role  =  Auth::user()->role;
     //      $id  =  Auth::user()->id;
     //      if ($role  != 'admin') {
     //           $allleads->leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')
     //                ->where('assignleads.employee_id', $id);
     //      }
     //      $data['lead_count_all'] = $allleads->count();

     //      // today count

     //      if ($role == 'admin') {
     //           $data['lead_count_today'] =  leadModel::whereDate('created_at', now())->count();
     //           $data['lead_count_today'] = leadModel::whereDate('created_at', now())->count();
     //           $data['lead_count_paid'] = leadModel::where('status', 'paid')->count();
     //           $data['lead_count_modifiedtoday'] = leadModel::whereDate('updated_at', now())->count();
     //           $data['lead_count_today_followup'] = leadModel::where('followup', date('Y-m-d'))->count();


     //           $data['topFiveSalesSum'] = DB::table('paymen_received as pr')->where('status', 'Approved')->sum('payment');
     //      } else {
     //           $data['lead_count_today'] =  leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')->whereDate('assignleads.created_at', now())->count();

     //           $data['topFiveSalesSum'] = DB::table('paymen_received as pr')->where('add_by', Auth::user()->id)->where('status', 'Approved')->sum('payment');

     //           $data['lead_count_paid'] = leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')->where('assignleads.status', 'paid')->count();

     //           $data['lead_count_modifiedtoday'] =
     //                leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')->whereDate('assignleads.updated_at', now())->count();

     //           $data['lead_count_today_followup'] = DB::table('leads_followups')->where('date', date('Y-m-d'))->where('add_by',   $id)->count();

     //           // leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')->join('leads_followups','leads_followups.lead_id','leads.id')->where('leads_followups.date', date('Y-m-d'))->where('leads_followups.add_by', date('Y-m-d'))->count();
     //      }




     //      return view('admin.dashboard', $data);
     // }



     public function index()
     {

          $currentMonth = Carbon::now()->month;
          $currentYear = Carbon::now()->year;
          $data['company_admin'] = User::where('role', '!=', 'admin')->count();
          $data['approved'] =  User::getcount('admin', 1);
           $data['agent']=User::where('role','agent')->count();
     
          $data['notapproved'] =  User::getcount('admin', 0);
          $data['serviceaggrementexpiry'] = ServiceModel::whereIn('risk_id', RiskModel::pluck('id'))->whereDate('expirydate', '>', now())->groupBy('risk_id')->get(['risk_id'])->count();
          $data['serviceaggrementcount'] = ServiceModel::whereIn('risk_id', RiskModel::pluck('id'))->groupBy('risk_id')->get(['risk_id'])->count();
          $data['riskcount'] =DB::table('users')->where('role','user')->count();
          $data['mrcount'] = PurchasedPlan::where('company_id', Auth::user()->id)->whereNotNull('alloted_user_id')->count();

          // Leads handling count
          $allleads = leadModel::query();
          $role = Auth::user()->role;
          $id = Auth::user()->id;

          if ($role != 'admin') {
               $allleads->leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')->where('is_duplicate', 0)
                    ->where('assignleads.employee_id', $id);
          } else {
               $allleads->where('is_duplicate', 0);
          }

          $data['lead_count_all'] = $allleads->count();

          // Today count
          if ($role == 'admin') {
               $data['lead_count_today'] = leadModel::whereDate('created_at', now())->count();
               $data['lead_count_paid'] = leadModel::where('status', 'paid')->count();
               $data['lead_count_modifiedtoday'] = leadModel::whereDate('updated_at', now())->count();
               $data['lead_count_today_followup'] = leadModel::where('followup', date('Y-m-d'))->count();

               // ->whereMonth('approved_or_reject_date', $currentMonth)
               //     ->whereYear('approved_or_reject_date', $currentYear)

               $data['topFiveSalesSum'] = DB::table('project_quotations as pr')
                    ->where('status', 1)
                    ->whereMonth('approved_or_reject_date', $currentMonth)
                    ->whereYear('approved_or_reject_date', $currentYear)

                    ->sum('amount');

          } else {
               $data['lead_count_today'] = leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')
                    ->where('assignleads.employee_id', $id)->where('is_duplicate', 0)
                    ->whereDate('assignleads.created_at', now())
                    ->count();

               $data['lead_count_paid'] = leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')
                    ->where('assignleads.employee_id', $id)->where('is_duplicate', 0)
                    ->where('assignleads.status', 'paid')
                    ->count();

               $data['lead_count_modifiedtoday'] = leadModel::leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')
                    ->where('assignleads.employee_id', $id)->where('is_duplicate', 0)
                    ->whereDate('leads.updated_at', now())
                    ->count();

               $data['lead_count_today_followup'] = DB::table('leads_followups')
                    ->where('add_by', $id)
                    ->whereDate('date', date('Y-m-d'))
                    ->count();


               //                 ->whereMonth('approved_or_reject_date', $currentMonth)
               // ->whereYear('approved_or_reject_date', $currentYear)

               $data['topFiveSalesSum'] = DB::table('project_quotations as pr')
                    ->where('add_by', Auth::user()->id)
                    ->where('status', 1)

                    ->sum('amount');
          }

          $data['usertotal'] = DB::table('users')->where('role', 'user')->count();

          return view('admin.dashboard', $data);
     }







     public function logout()
     {
          Auth::logout();
          return redirect('admin/dashboard');
     }
     public function feedback()
     {
       $data['feedbacks'] = feedbaclModel::orderby('id','desc')->get();
       return view('admin.users.feedbacks',$data);
     }
}
