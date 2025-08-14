<?php

namespace App\Repositories;

use App\Models\GlobalModel;
use App\Models\QuestionModel;
use App\Models\RiskModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PDFMail;
use App\Models\User;
use App\Repositories\Sales\SalesInterface;
use Carbon\Carbon;

class SalesRepository implements SalesInterface
{
    public function index()
    {

        $data['users'] = User::whereNotIn('role', ['compliance'])->get();

        $currentMonth = $data['currentmonth'] = Carbon::now()->month;
        $currentYear = $data['currentYear'] =  Carbon::now()->year;
        $data['topFiveSalesSum'] = DB::table('paymen_received as pr')
            ->where('status', 'Approved')
            ->whereMonth('approved_or_reject_date', $currentMonth)
            ->whereYear('approved_or_reject_date', $currentYear)
            ->sum('payment');


        $data['topFiveSales'] = DB::table('paymen_received as pr')
            ->join('leads as l', 'pr.lead_id', '=', 'l.id')
            ->join('users as u', 'pr.add_by', '=', 'u.id')
            ->select(
                'pr.add_by',
                'u.name as user_name',
                DB::raw('SUM(pr.payment) as total_payment'),
                DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m") as month')
            )
            ->where('pr.status', 'Approved')
            ->whereMonth('pr.approved_or_reject_date', $currentMonth)
            ->whereYear('pr.approved_or_reject_date', $currentYear)
            ->groupBy('pr.add_by', 'u.name', DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'))
            ->orderBy('total_payment', 'desc')
            ->paginate(50);

        return view('admin.sales.list', $data);
    }

    public function filter($data)
    {
        $query = DB::table('paymen_received as pr')
            ->join('leads as l', 'pr.lead_id', '=', 'l.id')
            ->join('users as u', 'pr.add_by', '=', 'u.id')
            ->select(
                'pr.add_by',
                'u.name as user_name',
                DB::raw('SUM(pr.payment) as total_payment'),
                DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m") as month')
            )
            ->where('pr.status', 'Approved');

        // Handle date filtering
        if (isset($data['from']) && isset($data['to'])) {

            // Handle both `from` and `to` dates as a range
            $query->whereBetween(DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'), [$data['from'], $data['to']]);
        } elseif (isset($data['from'])) {
            // Handle only `from` date
            $query->where(DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'), '>=', $data['from']);
        } elseif (isset($data['to'])) {
            // Handle only `to` date
            $query->where(DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'), '<=', $data['to']);
        }

        // Handle employee filtering if `employee_id` is provided
        if (isset($data['employee_id'])) {
            $query->where('pr.add_by', $data['employee_id']);
        }

        // Group by and order by total payment
        $query->groupBy('pr.add_by', 'u.name', DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'))
            ->orderBy('total_payment', 'desc');

        // Get the filtered data and total count
        $filteredData = $query->get();
        $totalCount = $filteredData->sum('total_payment');

        $data['topFiveSales'] = $filteredData;

        $table = (string)view('admin.sales.table', $data)->render();
        return response()->json(['code' => 216, 'data' => $table, 'totalcount' => $totalCount]);
    }
    public function getsales($userid, $month, $year)
    {
        $data['users'] = User::whereNotIn('role', ['compliance'])->get();

        $currentMonth = $data['currentmonth'] = $month;
        $currentYear = $data['currentYear'] =  $year;
        $data['topFiveSalesSum'] = DB::table('paymen_received as pr')
            ->where('status', 'Approved')
            ->where('add_by', $userid)
            ->whereMonth('approved_or_reject_date', $currentMonth)
            ->whereYear('approved_or_reject_date', $currentYear)
            ->sum('payment');



        // Retrieve top five sales for the specific user


        $data['paymentlist'] =
            DB::table('paymen_received as pr')
            ->join('leads as l', 'pr.lead_id', '=', 'l.id')
            ->join('users as u', 'pr.add_by', '=', 'u.id')
            ->where('pr.add_by', $userid)
            ->whereMonth('pr.approved_or_reject_date', $currentMonth)
            ->whereYear('pr.approved_or_reject_date', $currentYear)
            ->where('pr.status', 'Approved')
            ->select('pr.payment', 'pr.created_at', 'u.name as ename', 'u.unique_id', 'l.name', 'l.email', 'l.id as lead_id', 'l.unique_id as ucode')
            ->paginate(50);



        return view('admin.sales.particular', $data);
    }
    public function getsalesfromto($userid, $from, $to = null)
    {
        $data['users'] = User::whereNotIn('role', ['compliance'])->get();

        // Set the 'from' month and year
        $fromMonth = $data['fromMonth'] = substr($from, 5, 2); // Extract the month from the 'from' date
        $fromYear = $data['fromYear'] = substr($from, 0, 4);   // Extract the year from the 'from' date
    
        // Set the 'to' month and year if provided; otherwise, use the current month and year
        $toMonth = $to ? substr($to, 5, 2) : now()->format('m');
        $toYear = $to ? substr($to, 0, 4) : now()->format('Y');
        $to = '';
        // Calculate the total sum of sales for the specific user within the date range
        $query = DB::table('paymen_received as pr')
            ->where('status', 'Approved')
            ->where('add_by', $userid);
    
        // Apply date filters based on the presence of 'from' and 'to' dates
        if ($from && $to) {
            $query->where(function ($q) use ($fromYear, $fromMonth, $toYear, $toMonth) {
                $q->whereYear('approved_or_reject_date', '>=', $fromYear)
                    ->whereMonth('approved_or_reject_date', '>=', $fromMonth)
                    ->whereYear('approved_or_reject_date', '<=', $toYear)
                    ->whereMonth('approved_or_reject_date', '<=', $toMonth);
            });
        } elseif ($from) {

            $query->whereYear('approved_or_reject_date', $fromYear)
                ->whereMonth('approved_or_reject_date', $fromMonth);
        }
    
        $data['topFiveSalesSum'] = $query->sum('payment');
    
        // Retrieve payment list for the specific user within the date range
        $query = DB::table('paymen_received as pr')
            ->join('leads as l', 'pr.lead_id', '=', 'l.id')
            ->join('users as u', 'pr.add_by', '=', 'u.id')
            ->where('pr.add_by', $userid)
            ->where('pr.status', 'Approved');
    
        // Apply date filters based on the presence of 'from' and 'to' dates
        if ($from && $to) {
            $query->where(function ($q) use ($fromYear, $fromMonth, $toYear, $toMonth) {
                $q->whereYear('pr.approved_or_reject_date', '>=', $fromYear)
                    ->whereMonth('pr.approved_or_reject_date', '>=', $fromMonth)
                    ->whereYear('pr.approved_or_reject_date', '<=', $toYear)
                    ->whereMonth('pr.approved_or_reject_date', '<=', $toMonth);
            });
        } elseif ($from) {
            $query->whereYear('pr.approved_or_reject_date', $fromYear)
                ->whereMonth('pr.approved_or_reject_date',  $fromMonth);
        }
    
        $data['paymentlist'] = $query->select(
            'pr.payment',
            'pr.created_at',
            'u.name as ename',
            'u.unique_id',
            'l.name',
            'l.email',
            'l.id as lead_id',
            'l.unique_id as ucode'
        )->paginate(50);
    

        return view('admin.sales.particular', $data);
    }
}
