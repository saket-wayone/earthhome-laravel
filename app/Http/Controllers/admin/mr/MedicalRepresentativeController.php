<?php

namespace App\Http\Controllers\admin\mr;

use App\Http\Controllers\Controller;
use App\Http\Requests\PausedMrRequest;
use Illuminate\Http\Request;
use App\Repositories\Mr\MrInterface;
use Illuminate\Support\Facades\Session;
use PDO;

class MedicalRepresentativeController extends Controller
{
   protected $mrinterface;
   public function __construct(MrInterface $mrinterface)
   {
      $this->mrinterface = $mrinterface;
   }
   public function index()
   {
      return $this->mrinterface->index();
   }
   public function history()
   {
      return $this->mrinterface->history();
   }
   public function create()
   {

      return $this->mrinterface->create();
   }
   public function purchasecredit(Request $request)
   {
      return $this->mrinterface->purchasecredit($request->all());
   }
   public function renewupdate(Request $request)
   {
      return $this->mrinterface->renewupdate($request->all());
   }
   public function license()
   {
      return $this->mrinterface->license();
   }
   public function notused()
   {
      return $this->mrinterface->notused();
   }

   public function chhosedplan(Request $request)
   {
      return $this->mrinterface->chhosedplan($request);
   }

   public function paused($id)
   {
      return $this->mrinterface->paused($id);
   }
   public function pausedmr(PausedMrRequest $request)
   {
      return $this->mrinterface->pausedmr($request);
   }
   public function edit(Request $request)
   {
      return $this->mrinterface->edit($request->id);
   }
   public function companychhosedplan($id)
   {
      return $this->mrinterface->companychhosedplan($id);
   }
   public function renew2(Request  $request)
   {

      $data['ids']= Session::get('ids');
      $data['type']= Session::get('type');
      return $this->mrinterface->renew($data);
   }

   public function renew(Request $request)
{
    // Handle renewal process using $request->ids
    
    $ids = $request->ids;

    Session::put('ids', $ids);
    Session::put('type', $request->type);
    return true;
    
    // Redirect to the renew page
}
   public function update(Request $request)
   {

      $data['id'] = $request->id;
      $data['mrdata'] =  $request->all();
      return $this->mrinterface->update($data);
   }

   
}
