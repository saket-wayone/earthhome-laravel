<?php

namespace App\Repositories;

use App\Models\GlobalModel;
use App\Models\QuestionModel;
use App\Models\RiskModel;
use App\Repositories\Risk\RiskInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PDFMail;

class RiskRepository implements RiskInterface
{
    public function index(): View
    {

        if(in_array(Auth::user()->role ,['BDE','Manager'])){    
           
            $data['riskmodel'] = GlobalModel::getDataOrderByiDesc('risk','','','','desc',true);
        }else{
            $data['riskmodel'] = GlobalModel::getDataOrderByiDesc('risk');
        }
        return view('admin.risk.list', $data);
    }
    public function create()
    {
        $data['questions'] = QuestionModel::with('subquestions', 'options')->get();
        return view('admin.risk.create', $data);
    }
    public function filter($filter)
    {
      $query = RiskModel::query();

    if (isset($filter)) {
        $query->where('email', 'like', '%' . trim($filter) . '%')
              ->orWhere('phone', 'like', '%' . trim($filter) . '%');
    }

        $totalCount = $query->count();
         $data['riskmodel'] = $query->orderby('id', 'desc')->get();
         
         
          $table = (string)view('admin.risk.table', $data)->render();
        return response()->json(['code' => 215, 'data' => $table ,'totalcount'=>$totalCount]);
    }
    public function checkmobile($data)
    {
        $check = RiskModel::where('phone',$data['phone'])->first();
        if(!empty($check)){
            return response()->json([
                'code' => 409, 'message' => 'Risk Assement addedd successfully!', 'email' => $check->email,
                'name' => $check->name,
                'phone' => $check->phone, 'risk' => $check->riskfactor, 'points' => $check->totalpoints, 'id' => $check->id
            ]);
        }else{
            return response()->json([
                'code' => 200, 'message' => 'Risk Assement addedd successfully!'
            ]);

        }
        
        return response()->json();
    }

    public function download($data)
    {
        // Fetch the risk model
         $risk['riskmodel'] = $this->getcommandata($data)['riskmodel'];

        // Fetch questions with subquestions and options
        $risk['questions'] = $this->getcommandata($data)['questions'];


        // Fetch serviceaggrment
        $risk['serviceagreement'] = $this->getcommandata($data)['serviceagreement'];

        // Fetch user responses joined with options
        $risk['answers'] =$this->getcommandata($data)['answers'];

        // Pass data to the view
        return view('admin.risk.pdf', compact('risk'));
    }
    public function download2($data)
    {
        
         // Fetch the risk model
         $risk['riskmodel'] = $this->getcommandata($data)['riskmodel'];

        // Fetch questions with subquestions and options
        $risk['questions'] = $this->getcommandata($data)['questions'];


        // Fetch serviceaggrment
        $risk['serviceagreement'] = $this->getcommandata($data)['serviceagreement'];

        // Fetch user responses joined with options
        $risk['answers'] =$this->getcommandata($data)['answers'];
        // $pdf = Pdf::loadView('admin.service.pdf', compact('risk'));
        // return $pdf->stream('document.pdf');

        // Pass data to the view
        return view('admin.service.pdf', compact('risk'));
    
    }
    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  RiskModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  RiskModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  RiskModel::where('id', $data['id'])->delete();
        }
    }
    public function edit($data)
    {
        
         // Fetch the risk model
         $risk['riskmodel'] = $this->getcommandata($data)['riskmodel'];

         // Fetch questions with subquestions and options
         $risk['questions'] = $this->getcommandata($data)['questions'];
 
         // Fetch user responses joined with options
         $risk['answers'] =$this->getcommandata($data)['answers'];

        return view('admin.risk.edit', compact('risk'));
    }


  
    static public function getcommandata($id){
         // Fetch the risk model
         $risk['riskmodel'] = GlobalModel::getSingleData('risk', 'id', $id);
         $risk['serviceagreement'] = GlobalModel::getSingleData('serviceagreement', 'risk_id', $id);
         $risk['questions'] = QuestionModel::with(['subquestions.options', 'options'])->get();
         $risk['answers'] =  DB::table('userresponse')
         ->join('options', 'options.id', '=', 'userresponse.option_id')
         ->where('userresponse.risk_id', $id)
         ->get();
         return $risk;
 
    }
}
