<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\SourceModel;
use App\Models\Withdraw;
use App\Repositories\Withdraw\WithdrawInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class WithdrawelRepository implements WithdrawInterface
{
    public function index()
    {
         $data['withdraw'] = Withdraw::with('User')->orderby('id', 'desc')->paginate(50);
        return   view('admin.withdraw.list', $data);
    }
    
    public function getCurrentStatus($id)
    {
        // current status
        $lead =  Withdraw::find($id['id']);
        return view('admin.withdraw.updatestatus', data: compact('lead'));
    }
    public function UpdateCurrentStatus($data)
    {
        // current status
        $lead =  Withdraw::find($data['leadid']);
        $lead->status =  $data['status'];
        $lead->save();
        return response()->json(['code' => 200, 'message' => 'Status has been updated successfully!']);
    }
    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  Withdraw::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'removes') {
            // return  PaidAmountModel::where('id', $data['id'])->delete();
            return  Withdraw::where('id', $data['id'])->delete();
        }
        if ($type == 'deactivate') {
            return  Withdraw::where('id', $data['id'])->update(['flag' => 0]);
        }


    

        if ($type == 'remove') {
            return  Withdraw::where('id', $data['id'])->delete();
        }
    }

}
