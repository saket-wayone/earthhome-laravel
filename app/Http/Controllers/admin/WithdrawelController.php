<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Withdraw;
use App\Repositories\Withdraw\WithdrawInterface;
use Illuminate\Http\Request;

class WithdrawelController extends Controller
{
    protected $withdrawRepository;
    public function __construct(WithdrawInterface $withdrawRepository)
    {
        $this->withdrawRepository = $withdrawRepository;
    }
    public function index(Request $request)
    {
        return $this->withdrawRepository->index();
    }
    public function getCurrentStatus(Request $request)
    {
        return $this->withdrawRepository->getCurrentStatus($request);
    }
    public function delete(Request $request)
    {
        return $this->withdrawRepository->delete($request);
    }

    public function UpdateCurrentStatus(Request $request)
    {

        $lead = Withdraw::find($request->leadid);
        // check if the status has change 
        if ($lead->status != $request->status) {
            if ($request->status  == 'Completed') {
                // deduct the amount from the transporter
                $updateWallet = Wallet::where('user_id', $lead->user_id)->first();
                $updateWallet->balance = $updateWallet->balance  - $lead->amount;
                $updateWallet->save();
            }
        }
        if ($lead) {
            // Update lead data

            // $lead->difference = $request->difference;
            $lead->status = $request->status;
                        $lead->payment_mode2 = $request->payment_mode2;




            if ($request->hasFile('proof')) {
                $file = $request->file('proof');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Manually define the correct path based on your directory structure
                // return $destinationPath = base_path('public_html/uploads/proofs');
                $destinationPath = '/home/u239133126/domains/kapilandsons.com/public_html/uploads/proofs';

                // Ensure the destination folder exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Move the file to the specified destination
                $file->move($destinationPath, $fileName);

                // Save the file path to the database (relative to the public directory)
                $lead->proof = 'uploads/proofs/' . $fileName;
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
}
