<?php

namespace App\Repositories;

use App\Models\Phase;
use App\Models\ProjectQuotation;
use App\Repositories\Project\ProjectInterface;
use Illuminate\Support\Facades\Auth;

class ProjectRepository implements ProjectInterface
{

    public function index()
    {
        // now get those project that has verified by admin once the payment has been done
        $data['projects'] = Phase::join('project_quotations as pq', 'pq.phase_id', 'phases.id')
            ->where([['main', 1], ['pq.status', 1]])
            ->orderby('phases.id', 'desc')
            ->select('phases.*', 'pq.id as quotationId')
            ->get();
        return view('admin.projects.list', $data);
    }
    public function detail($id)
    {
        $data['phases'] = Phase::where([['lead_id', $id]])->get();
        return view('admin.projects.detail', $data);
    }

    public function getbalance($phaseId)
    {
         $balance =    ProjectQuotation::where('phase_id', $phaseId)->where('status', 1)->sum('balance');

        $totalamount =    Phase::where('id', $phaseId)->first();

        $lead['phase_receipts']  =  ProjectQuotation::with('phasename')->where('phase_id', $phaseId)->orderby('id', 'desc')->get();
        $paymentBalance =  view('admin.projects.payment', $lead)->render();
        $whole = ['balance' => $balance ?? $totalamount->total_amount, 'table' => $paymentBalance, 'lead_id' => $totalamount->lead_id,'overallprojectCost'=>$totalamount->total_amount];


        return $this->sendJsonResponse(200, 'Balance Fecteched Successfully', $whole);
    }

    public function sendJsonResponse($code, $message, $data = [])
    {

        return response()->json(['code' => $code, 'message' => $message, 'data' => $data], $code);
    }

    public function updatepayment($request)
    {
        $insert['amount'] =  $request['paidamount'];
        $balance = $request['lastamount'] -  $request['paidamount'];
        $insert['balance'] = $balance;
        $insert['phase_id'] = $request['phase_id'];
        $insert['lead_id'] = $request['lead_id2'];
        $insert['add_by'] = Auth::user()->id;


        if (isset($request['recepit'])) {
            $file = $request['recepit']; // Accessing the file from the array
            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                // Use the real extension in the filename
                $imageName = time() . '.' . $extension;          
                
                $file->move(public_path('uploads/receipts/'), $imageName);
                $insert['recepit'] = "uploads/receipts/$imageName";
            } else {
                throw new \Exception("Invalid quotation file.");
            }
        }
        $insert['created_at'] = now();
        $phaseAdded = ProjectQuotation::insert($insert);


        if ($phaseAdded) {
            return response()->json(['code' => 200, 'message' => 'Payment added Successfully!']);
        } else {
            return response()->json(['code' => 500, 'message' => 'Something went wrong please try again ']);
        }
    }
}
