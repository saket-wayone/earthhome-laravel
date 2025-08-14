<?php

namespace App\Http\Controllers\admin\leads;

use App\Exports\LeadsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\HoldPaymentRequest;
use App\Http\Requests\LeadRequest;
use App\Http\Requests\withdrawrequest;
use App\Repositories\leads\LeadInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use App\Models\leadModel;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;



class LeadController extends Controller
{
    protected $leadinterface;
    public function __construct(LeadInterface $leadinterface)
    {
        $this->leadinterface = $leadinterface;
    }


    public function import(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Excel::import(new LeadsImport, $request->file('file'));

        return redirect()->route('leads.all')->with('success', 'Leads imported successfully.');
    }

    public function leadstatus(Request $request)
    {
        return $this->leadinterface->leadstatus($request->slug);
    }

    public function index()
    {

        return $this->leadinterface->index();
    }
    public function poolindex()
    {
        return $this->leadinterface->poolindex();
    }
    public function assigned()
    {
        return $this->leadinterface->assigned();
    }
    public function assignedtoday()
    {
        return $this->leadinterface->assignedtoday();
    }
    public function status(Request $request)
    {
        return $this->leadinterface->status($request->status);
    }
    public function create()
    {
        return $this->leadinterface->create();
    }
    public function store(LeadRequest $data)
    {
        return $this->leadinterface->store($data);
    }
    public function edit(Request $request)
    {
        return  $this->leadinterface->edit($request->id);
    }
    public function update(LeadRequest $data)
    {
        return  $this->leadinterface->update($data);
    }

    public function delete(Request $request)
    {
        return  $this->leadinterface->delete($request);
    }

    public function extract()
    {
        return $this->leadinterface->extract();
    }
    public function assign()
    {

        return  $this->leadinterface->assign();
    }
    public function assignleadcount(Request $request)
    {
        return  $this->leadinterface->unassignleadcount($request->value);
    }
    public function assignstore(Request $request)
    {
        return  $this->leadinterface->assignstore($request);
    }
    public function donwloadsampleexcel()
    {
        return  $this->leadinterface->donwloadsampleexcel();
    }
    public function filter(Request $request)
    {
        return  $this->leadinterface->filter($request->all());
    }
    public function extractFilter(Request $request)
    {
        return  $this->leadinterface->extractFilter($request->all());
    }
    public function payment()
    {
        return  $this->leadinterface->payment();
    }
    public function makeCall(Request $request) {}

    public function phase(Request $request)
    {
        return $this->leadinterface->phase($request);
    }

    public function existproject(Request $request)
    {
        return $this->leadinterface->existproject($request->id);
    }
    public function getCurrentStatus(Request $request)
    {
        return $this->leadinterface->getCurrentStatus($request);
    }
    public function UpdateCurrentStatus(Request $request)
    {
        return $this->leadinterface->UpdateCurrentStatus($request);
    }
    public function updatepaymentstatus(Request $request)
    {
        return $this->leadinterface->updatepaymentstatus($request->all());
    }
    public function holdamountstatus(leadModel $lead)
    {
        return $this->leadinterface->holdamountstatus($lead);
    }
    public function invoice(leadModel $lead)
    {
        return $this->leadinterface->invoice($lead);
    }
    public function updatepayment(leadModel $lead)
    {
        return $this->leadinterface->updatePayment($lead);
    }

    public function holdpaymentstatusUpdate(HoldPaymentRequest $request)
    {

        $lead = leadModel::find($request->lead_id);

        if ($lead) {
            // Update lead data
            if (isset($request->hold_amount_status)) {
                $lead->hold_amount_status = $request->hold_amount_status;
            }

            if (isset($request->payment_date2)) {
                $lead->payment_date2 = $request->payment_date2;
            }
            if (isset($request->less_quantity)) {
                $lead->less_quantity = $request->less_quantity;
            }
            if (isset($request->difference)) {
                $lead->difference = $request->difference;
            }
            // $lead->difference = $request->difference;
            $lead->paymode = $request->paymode;

            $lead->updated_rate = $request->updated_rate;
            $lead->remaining_hold_amount = $request->remaining_hold_amount;

            if (isset($request->payment_option1)) {
                $lead->payment_option1  =  $request->payment_status;
            }
            if (isset($request->phonepay_number1)) {
                $lead->phonepay_number1  =  $request->phonepay_number1;
            }
            if (isset($request->holder1)) {
                $lead->holder1  =  $request->holder1;
            }
           
           
            if (isset($request->bankname1)) {
                $lead->bankname1 = $request->bankname1;
            }
            if (isset($request->ifsc1)) {
                $lead->ifsc1 = $request->ifsc1;
            }
            if (isset($request->account_number1)) {
                $lead->account_number1  =  $request->account_number1;
            }
            if (isset($request->samebank)) {
                $lead->samebank  =  $request->samebank;
            }
            if (isset($request->payment_option1)) {
                $lead->payment_option1  =  $request->payment_option1;
            }

            // Handle file upload for proof of delivery
            // if ($request->hasFile('proof')) {
            //     $file = $request->file('proof');
            //     $fileName = time() . '_' . $file->getClientOriginalName();

            //     // Define the public path where the file should be stored
            //     $destinationPath = public_path('uploads/proofs');

            //     // Move the file to the specified destination
            //     $file->move($destinationPath, $fileName);

            //     // Save the file path to the database (relative to the public directory)
            //     $lead->proof = 'uploads/proofs/' . $fileName;
            // }

            if ($request->hasFile('proof')) {
                $files = $request->file('proof');
                $filePaths = [];

                foreach ($files as $file) {
                    // Generate a unique filename for each file
                    $fileName = time() . '_' . $file->getClientOriginalName();
                 $destinationPath = public_path('uploads/proofs');
                    $destinationPath = '/home/u720059594/domains/kapilandsons.com/public_html/uploads/proofs';
                    // Manually define the correct path based on your directory structure
                    // $destinationPath = '/home/u239133126/domains/kapilandsons.com/public_html/uploads/proofs';

                    // Ensure the destination folder exists
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    // Move the file to the specified destination
                    $file->move($destinationPath, $fileName);

                    // Save the file path relative to the public directory
                    $filePaths[] = 'uploads/proofs/' . $fileName;
                }

                // Save the file paths to the database as a JSON array or comma-separated string
                $lead->proof = json_encode($filePaths);  // Or implode(',', $filePaths) if you prefer a comma-separated string
            }



            // Save changes to the database
            $lead->save();

            return response()->json(['code' => 200, 'message' => 'Payment updated successfully!']);


            // Redirect or return response
            // return redirect()->back()->with('success', 'Hold payment status updated successfully.');
        } else {

            return response()->json(['code' => 401, 'message' => 'Oops! Something went wrong!']);
        }
        // If lead is not found, return error



    }

    public function exportLeads(Request $request)
    {
        // Collect and filter the data as done in the filter function
        $data = $request->all();

        // Return the exported Excel file
        return Excel::download(new LeadsExport($data), 'jobs.xlsx');
    }

    public  function commission()
    {
        return $this->leadinterface->commission();
    }
    public  function withdraw()
    {
        return $this->leadinterface->withdraw();
    }
    public  function withdrawrequest(withdrawrequest $withdraw)
    {
        return $this->leadinterface->withdrawrequest($withdraw->all());
    }
}
