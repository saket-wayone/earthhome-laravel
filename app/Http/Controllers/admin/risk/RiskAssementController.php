<?php

namespace App\Http\Controllers\admin\risk;

use App\Http\Controllers\Controller;
use App\Models\OptionModel;
use App\Models\RiskModel;
use App\Models\SubQuestionModel;
use App\Repositories\Risk\RiskInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PDFMail;

class RiskAssementController extends Controller
{

    protected $riskinterface;

    public function __construct(RiskInterface $riskinterface)
    {
        $this->riskinterface  = $riskinterface;
    }

    public function index()
    {
        return  $this->riskinterface->index();
    }
    public function edit(Request $request)
    {

        return  $this->riskinterface->edit($request->id);
    }

    public function create()
    {
        return  $this->riskinterface->create();
    }
    public function checkmobile(Request $request)
    {
        return  $this->riskinterface->checkmobile($request->all());
    }
    public function store(Request $request)
    {

        // Store basic risk data
        $riskId = RiskModel::insertGetId([
            'email' => $request->email,
            'name' => $request->name,
            // 'address' => $request->address,
            // 'gender' => $request->gender,
            'phone' => $request->phone,

            'assess_name' => $request->assese_name,
            'previous_advisory' => $request->previous_advisory,
            'firm' => $request->firm,
            'previous_loss' => $request->previous_loss,
            'loss_percentage' => $request->loss_percentage,
            'liability' => $request->liability,
            'other_Liability' => $request->other_Liability,
            'age' => $request->age,
            'ever_did_trade' => $request->ever_did_trade,
            'created_at' => now()
        ]);

        // Store responses to main questions
        $responses = $request->input('response');
        foreach ($responses as $questionId => $selectedOptionId) {
            $data = [
                'risk_id' => $riskId,
                'question_id' => $questionId,
                'option_id' => $selectedOptionId
            ];

            // Fetch option points and store them
            $optionPoint = OptionModel::where('id', $selectedOptionId)->first();
            $data['points'] = $optionPoint->point;
            $data['created_at'] = now();

            DB::table('userresponse')->insert($data);
        }

        // Store responses to subquestions
        $subquestionResponses = $request->input('subquestionoption');
        foreach ($subquestionResponses as $subquestionId => $selectedOptionId) {
            $qid = SubQuestionModel::where('id', $subquestionId)->first();
            $data = [
                'risk_id' => $riskId,
                'subquestion_id' => $subquestionId,
                'option_id' => $selectedOptionId,
                'question_id' => $qid->question_id,
            ];

            // Fetch option points and store them
            $optionPoint = OptionModel::where('id', $selectedOptionId)->first();
            $data['points'] = $optionPoint->point;
            $data['created_at'] = now();

            DB::table('userresponse')->insert($data);
        }

        // get the total of the risk and updaye 
        $pointscalculate =  DB::table('userresponse')->where('risk_id', $riskId)->get();
        $totalpoints =  0;
        if (!empty($pointscalculate)) {
            foreach ($pointscalculate as $totallist) {
                $totalpoints += $totallist->points;
            }
        }

        // Determine the risk category
        $risk_category = 'Low Risk';
        if ($totalpoints >= 5 && $totalpoints <= 10.4) {
            $risk_category = 'Moderate Risk';
        } elseif ($totalpoints >= 10.5 && $totalpoints <= 15.4) {
            $risk_category = 'High Risk';
        } elseif ($totalpoints >= 15.5) {
            $risk_category = 'Very High Risk';
        }
        $age =  $request->age;

        if ($age >= 60 || $age <= 18) {
            $risk_category = 'Moderate Risk';
        }




        if ($request->has('certificateid')) {
            $saveddata['certificateid'] = $request->certificateid;
        }

        if ($request->hasFile('scannedimage')) {
            $companyname = 'certifcates'; // Make sure you define this variable appropriately
            $imageName = time() . '.webp';
            $request->file('scannedimage')->move(public_path("uploads/$companyname"), $imageName);
            $saveddata['scannedimage'] = "uploads/$companyname/$imageName";
        }

        $saveddata['totalpoints'] = $totalpoints;
        $saveddata['riskfactor'] = $risk_category;
        if ($request->has('certificateid')) {
            $saveddata['certificateid'] = $request->certificateid;
        }

        if ($request->hasFile('scannedimage')) {
            $companyname = 'certifcates'; // Make sure you define this variable appropriately
            $imageName = time() . '.webp';
            $request->file('scannedimage')->move(public_path("uploads/$companyname"), $imageName);
            $saveddata['scannedimage'] = "uploads/$companyname/$imageName";
        }

        $saveddata['add_by'] = Auth::user()->id;


        RiskModel::where('id', $riskId)->update($saveddata);
        

        // now return the response with the information show 
         $response =  $this->sendmail($riskId, $request->email);
        //  $response = 1;
        if ($response) {
            return response()->json([
                'code' => 409, 'message' => 'Risk Assement addedd successfully!', 'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone, 'risk' => $risk_category, 'points' => $totalpoints, 'id' => $riskId
            ]);
       
        }

       
    }

    public function sendmail($id, $mailto)
    {

        Mail::to($mailto)->send(new PDFMail($id ,1));
        return "mail send successfully!";
    } 

    public function download(Request $request)
    {
        return  $this->riskinterface->download($request->id);
    }
    public function filter(Request $request)
    {
        return  $this->riskinterface->filter($request->search);
    }
      public function download2(Request $request)
    {
        return  $this->riskinterface->download2($request->id);
    }
    public function delete(Request $request)
    {
        return  $this->riskinterface->delete($request);
    }



    public function update(Request $request)
    {

        // Store basic risk data
        $query = RiskModel::where('id', $request->id)->update([
            'email' => $request->email,
            'name' => $request->name,
            // 'address' => $request->address,
            // 'gender' => $request->gender,
            'phone' => $request->phone,
            'assess_name' => $request->assese_name,
            'previous_advisory' => $request->previous_advisory,
            'firm' => $request->firm,
            'previous_loss' => $request->previous_loss,
            'loss_percentage' => $request->loss_percentage,
            'liability' => $request->liability,
            'other_Liability' => $request->other_Liability,
            'age' => $request->age,
            'ever_did_trade' => $request->ever_did_trade,
        ]);
        $riskId =  $request->id;

        // delete the previus answers
        DB::table('userresponse')->where('risk_id', $request->id)->delete();
        // Store responses to main questions
        $responses = $request->input('response');
        foreach ($responses as $questionId => $selectedOptionId) {
            $data = [
                'risk_id' => $riskId,
                'question_id' => $questionId,
                'option_id' => $selectedOptionId
            ];

            // Fetch option points and store them
            $optionPoint = OptionModel::where('id', $selectedOptionId)->first();
            $data['points'] = $optionPoint->point;
            $data['created_at'] = now();

            DB::table('userresponse')->insert($data);
        }

        // Store responses to subquestions
        $subquestionResponses = $request->input('subquestionoption');
        foreach ($subquestionResponses as $subquestionId => $selectedOptionId) {
            $qid = SubQuestionModel::where('id', $subquestionId)->first();
            $data = [
                'risk_id' => $riskId,
                'subquestion_id' => $subquestionId,
                'option_id' => $selectedOptionId,
                'question_id' => $qid->question_id,
            ];

            // Fetch option points and store them
            $optionPoint = OptionModel::where('id', $selectedOptionId)->first();
            $data['points'] = $optionPoint->point;
            $data['created_at'] = now();

            DB::table('userresponse')->insert($data);
        }

        // get the total of the risk and updaye 
        $pointscalculate =  DB::table('userresponse')->where('risk_id', $riskId)->get();
        $totalpoints =  0;
        if (!empty($pointscalculate)) {
            foreach ($pointscalculate as $totallist) {
                $totalpoints += $totallist->points;
            }
        }

        // Determine the risk category
        $risk_category = 'Low Risk';
        if ($totalpoints >= 5 && $totalpoints <= 10.4) {
            $risk_category = 'Moderate Risk';
        } elseif ($totalpoints >= 10.5 && $totalpoints <= 15.4) {
            $risk_category = 'High Risk';
        } elseif ($totalpoints >= 15.5) {
            $risk_category = 'Very High Risk';
        }
        $age =  $request->age;

        if ($age >= 60 || $age <= 18) {
            $risk_category = 'Moderate Risk';
        }

        $saveddata['totalpoints'] = $totalpoints;
        $saveddata['riskfactor'] = $risk_category;
        if ($request->has('certificateid')) {
            $saveddata['certificateid'] = $request->certificateid;
        }

        if ($request->hasFile('scannedimage')) {
            $companyname = 'certifcates'; // Make sure you define this variable appropriately
            $imageName = time() . '.webp';
            $request->file('scannedimage')->move(public_path("uploads/$companyname"), $imageName);
            $saveddata['scannedimage'] = "uploads/$companyname/$imageName";
        }




        RiskModel::where('id', $riskId)->update($saveddata);

        // now return the response with the information show 

        return response()->json([
            'code' => 409, 'message' => 'Risk Assement Updated successfully!', 'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone, 'risk' => $risk_category, 'points' => $totalpoints , 'id'=>$riskId
        ]);
    }

}
