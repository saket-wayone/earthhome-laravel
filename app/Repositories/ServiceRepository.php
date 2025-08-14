<?php

namespace App\Repositories;

use App\Models\GlobalModel;
use App\Models\QuestionModel;
use App\Models\RiskModel;
use App\Models\ServiceModel;
use App\Repositories\Service\ServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\PDFMail;

class ServiceRepository implements ServiceInterface
{
    public function index()
    {

        $riskids = ServiceModel::select('risk_id')
            ->groupBy('risk_id')
            ->get()
            ->pluck('risk_id')
            ->toArray();
        $data['riskmodel'] = RiskModel::whereIn('id', $riskids)->orderby('id', 'desc')->get();
        return view('admin.risk.list', $data);
    }
    
      public function edit($id)
    {

  $data['aggrement'] = ServiceModel::join('risk', 'risk.id', '=', 'serviceagreement.risk_id')
    ->where('serviceagreement.id', $id)->select('serviceagreement.*','risk.*','serviceagreement.id as ID')
    ->first();            
            
        return view('admin.service.edit', $data);
    }
    public function expired()
    {

        $riskids = ServiceModel::select('risk_id')
            ->groupBy('risk_id')
            ->whereDate('expirydate', '>', now())
            ->get()
            ->pluck('risk_id')
            ->toArray();
        $data['riskmodel'] = RiskModel::whereIn('id', $riskids)->orderby('id', 'desc')->get();
        return view('admin.risk.list', $data);
    }
    public function create($id)
    {

        $data['getdata']  =  GlobalModel::getSingleData('risk', 'id', $id);
        return view('admin.service.create', $data);
    }


    public function viewscore($data)
    {
        // Fetch the risk model
        $risk['riskmodel'] = $this->getcommandata($data)['riskmodel'];

        // Fetch questions with subquestions and options
        $risk['questions'] = $this->getcommandata($data)['questions'];


        // Fetch serviceaggrment
        $risk['serviceagreement'] = $this->getcommandata($data)['serviceagreement'];

        // Fetch user responses joined with options
        $risk['answers'] = $this->getcommandata($data)['answers'];
        $pdf = Pdf::loadView('admin.service.pdf', compact('risk'));
        return $pdf->stream('document.pdf');

        // Pass data to the view
        // return view('admin.service.pdf', compact('risk'));
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  ServiceModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'deactivate') {
            return  ServiceModel::where('id', $data['id'])->update(['flag' => 0]);
        }

        if ($type == 'remove') {
            return  ServiceModel::where('id', $data['id'])->delete();
        }
    }
    public  function deleteserviceagreement($data)
    {
        $type = $data['type'];


        if ($type == 'delete') {

            // first update Risk
            $getId = ServiceModel::where('id', $data['id'])->first();
            RiskModel::where('id', $getId->risk_id)->update(['service' => 0]);
            ServiceModel::where('id', $data['id'])->delete();
        }
    }
    public  function store($validatedData)
    {
        $data = [
            'client_type' => $validatedData['client_type'],
            'clientname' => $validatedData['clientname'],
            'clientplace' => $validatedData['clientplace'],
            'days' => $validatedData['days'],
            'months' => $validatedData['months'],
            'package' => $validatedData['package'],
            'packageamount' => $validatedData['packageamount'],
            'paidamount' => $validatedData['paidamount'],
            'discountamount' => $validatedData['discountamount'],
            'discountpercentage' => $validatedData['discountpercentage'],
            'balanceamount' => $validatedData['balanceamount'],
            'bookingprofitamount' => $validatedData['bookingprofitamount'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'pancard' => $validatedData['pancard'],
            'investamount' => $validatedData['investamount'],
            'joining_date' => $validatedData['joining_date'],
            'expirydate' => $validatedData['expirydate'],
            'riskscore' => $validatedData['riskscore'],
            'risk_id' => $validatedData['risk_id'],
            'created_at' => now(),
        ];
        ServiceModel::insert($data);
        // update the service agrrement status here
        RiskModel::where('id', $validatedData['risk_id'])->update(['service' => 1 ,'address'=>$validatedData['clientplace'],'gender'=>$validatedData['gender']]);

        $response =  $this->sendmail($validatedData['risk_id'], $validatedData['email']);
        if ($response) {
            return response()->json(['message' => 'Data saved successfully!', 'data' => $data, 'code' => 200, 'id' => $validatedData['risk_id']], 200);
        }
    }
    
     public  function update($validatedData)
    {
        
        $data = [
            'client_type' => $validatedData['client_type'],
            'clientname' => $validatedData['clientname'],
            'clientplace' => $validatedData['clientplace'],
            'days' => $validatedData['days'],
            'months' => $validatedData['months'],
            'package' => $validatedData['package'],
            'packageamount' => $validatedData['packageamount'],
            'paidamount' => $validatedData['paidamount'],
            'discountamount' => $validatedData['discountamount'],
            'discountpercentage' => $validatedData['discountpercentage'],
            'balanceamount' => $validatedData['balanceamount'],
            'bookingprofitamount' => $validatedData['bookingprofitamount'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'pancard' => $validatedData['pancard'],
            'investamount' => $validatedData['investamount'],
            'joining_date' => $validatedData['joining_date'],
            'expirydate' => $validatedData['expirydate'],
            'riskscore' => $validatedData['riskscore'],
            'risk_id' => $validatedData['risk_id'],
            'created_at' => now(),
        ];
        
        ServiceModel::where('id',$validatedData['serviceaggrement_id'])->update($data);
        // update the service agrrement status here
        RiskModel::where('id', $validatedData['risk_id'])->update(['service' => 1 ,'address'=>$validatedData['clientplace'],'gender'=>$validatedData['gender']]);

        $response =  $this->sendmail($validatedData['risk_id'], $validatedData['email']);
        if ($response) {
            return response()->json(['message' => 'Data saved successfully!', 'data' => $data, 'code' => 200, 'id' => $validatedData['risk_id']], 200);
        }
    }

    public function viewserviceaggrement($id)
    {
        $data['service'] = GlobalModel::getSingleData('serviceagreement', 'risk_id', $id['id']);
        return view('admin.service.detail', $data);
    }


   

    public function score($data)
    {
        $score['score'] = GlobalModel::getSingleData('risk', 'id', $data['id']);
        return view('admin.risk.score', $score);
    }


    public function sendmail($id, $mailto)
    {

        Mail::to($mailto)->send(new PDFMail($id));
        return "mail send successfully!";
    }

    static public function getcommandata($id)
    {
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
