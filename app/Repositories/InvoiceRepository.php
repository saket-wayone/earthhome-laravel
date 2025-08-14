<?php

namespace App\Repositories;

use App\Models\InvoiceModel;
use App\Repositories\Invoice\InvoiceInterface;

class InvoiceRepository implements InvoiceInterface
{
    public function index()
    {
        $data['invoices'] = InvoiceModel::orderby('id', 'desc')->paginate(50);
        
        return view('admin.invoices.list', $data);
    }
    public function create()
    {
        return view('admin.invoices.add');
    }
    public function view($id)
    {
        $data['detail'] =  InvoiceModel::where('id', $id)->first();

        
        return view('admin.invoices.invoice', $data);
    }
    public function store($data)
    {
        $insert['co'] = $data['co'];
        $insert['address'] = $data['address'];
        $insert['igst'] = $data['igst'];
        $insert['company'] = $data['company'];
        $insert['status'] = $data['status'];
        $insert['gst'] = $data['gst'];
        $insert['services'] = json_encode($data['services']);
        $insert['invoice_date'] = $data['invoice_date'];
        $insert['invoice_due'] = $data['invoice_due'];
        $insert['email'] = $data['email'];
        $insert['phone'] = $data['phone'];
        $insert['subtotal'] = $data['subtotal'];
        $insert['totalCost'] = $data['totalCost'];
        $insert['unique_id'] = $this->getlastinvoiceCode();
        $insert['created_at'] = now();

        $insert =  InvoiceModel::insertGetId($insert);
        if ($insert) {
            return response()->json(['code' => 200, 'message' => 'Invoice has been created successfully!', 'id' => $insert]);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }


    public function update($data)
    {
        $insert['co'] = $data['co'];
        $insert['address'] = $data['address'];
        $insert['igst'] = $data['igst'];
        $insert['company'] = $data['company'];
        $insert['status'] = $data['status'];
        $insert['gst'] = $data['gst'];
        $insert['services'] = json_encode($data['services']);
        $insert['invoice_date'] = $data['invoice_date'];
        $insert['invoice_due'] = $data['invoice_due'];
        $insert['email'] = $data['email'];
        $insert['phone'] = $data['phone'];
        $insert['subtotal'] = $data['subtotal'];
        $insert['totalCost'] = $data['totalCost'];
        $insert['created_at'] = now();

        $insert =  InvoiceModel::whereId($data['invoiceid'])->update($insert);
        if ($insert) {
            return response()->json(['code' => 200, 'message' => 'Invoice has been Updated successfully!', 'id' => $data['invoiceid']]);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    static public  function getlastinvoiceCode()
    {
        $code =  'VOL/' . date('Y') . '#';
        $getlastid = InvoiceModel::orderBy('id', 'desc')->select('id', 'unique_id')->first();
        if (!empty($getlastid->unique_id)) {
            $unique_id = str_replace($code, "", $getlastid->unique_id);
            $code = $code . ($unique_id + 1);
        } else {
            $code = $code . "114";
        }

        return $code;
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  InvoiceModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'removes') {
            // return  PaidAmountModel::where('id', $data['id'])->delete();
            return  InvoiceModel::where('id', $data['id'])->delete();
        }
        if ($type == 'deactivate') {
            return  InvoiceModel::where('id', $data['id'])->update(['flag' => 0]);
        }


        if ($type == 'approve') {
            // return  PaidAmountModel::where('id', $data['id'])->update(['status' => 'Approved', 'approved_or_reject_date' => now()]);
            return  InvoiceModel::where('id', $data['id'])->update(['status' => 1, 'approved_or_reject_date' => now()]);
        }
        if ($type == 'declined') {
            // return  PaidAmountModel::where('id', $data['id'])->update(['status' => 'Declined', 'approved_or_reject_date' => now()]);
            return  InvoiceModel::where('id', $data['id'])->update(['status' => 2, 'approved_or_reject_date' => now()]);
        }

        if ($type == 'remove') {
            return  InvoiceModel::where('id', $data['id'])->delete();
        }
    }

    public function edit($id)
    {
        $data['invoices'] =  InvoiceModel::where('id', $id)->first();
        return view('admin.invoices.edit', $data);
    }

    public function filter($filter)
    {
        $query = InvoiceModel::query();

        if (isset($filter)) {
            $query->where('email', 'like', '%' . trim($filter) . '%')
                ->orWhere('phone', 'like', '%' . trim($filter) . '%')
                ->orWhere('co', 'like', '%' . trim($filter) . '%');
        }

        $totalCount = $query->count();
        $data['invoices'] = $query->orderby('id', 'desc')->paginate(500000000000);


        $table = (string)view('admin.invoices.table', $data)->render();
        return response()->json(['code' => 215, 'data' => $table, 'totalcount' => $totalCount]);
    }
}
