<?php

namespace App\Http\Controllers\admin\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Repositories\Invoice\InvoiceInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceInterface;
    public function __construct(InvoiceInterface  $invoiceInterface)
    {
         $this->invoiceInterface =  $invoiceInterface;
    }

    public function index(){

        return  $this->invoiceInterface->index();
    }
    public function create(){
        return  $this->invoiceInterface->create();
    }
    public function view(Request $request){
        return  $this->invoiceInterface->view($request->id);
    }
    public function store(InvoiceRequest $invoice){
        return  $this->invoiceInterface->store($invoice->all());
    }
    public function update(InvoiceRequest $invoice){
        return  $this->invoiceInterface->update($invoice->all());
    }

    public function delete(Request $request)
    {
        return  $this->invoiceInterface->delete($request);
    }
    public function edit(Request $request)
    {
        return  $this->invoiceInterface->edit($request->id);
    }

    public function filter(Request $request)
    {
        return  $this->invoiceInterface->filter($request->search);
    }
}
