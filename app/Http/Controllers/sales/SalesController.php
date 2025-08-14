<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Repositories\Sales\SalesInterface;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $salesInterface;
    public function __construct(SalesInterface $salesInterface)
    {
        $this->salesInterface  = $salesInterface;
    }
    public function index(Request $request)
    {
        return $this->salesInterface->index();
    }

    public function filter(Request $request)
    {
        return  $this->salesInterface->filter($request->all());
    }
    public function getsales(Request $request)
    {
        return  $this->salesInterface->getsales($request->userid, $request->month,$request->year);
    }
    public function getsalesfromto(Request $request)
    {
        return  $this->salesInterface->getsalesfromto($request->userid, $request->from,$request->to);
    }
    
}
