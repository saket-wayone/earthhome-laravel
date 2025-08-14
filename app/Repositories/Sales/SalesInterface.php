<?php 

namespace App\Repositories\Sales;

interface SalesInterface{
    public function index();
    public function filter($data);
    public function getsales($userid , $month , $year);
    public function getsalesfromto($userid , $from , $to);
   

}



?>