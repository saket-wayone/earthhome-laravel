<?php 
namespace App\Repositories\Withdraw;

interface  WithdrawInterface {
    public  function index();
    public function getCurrentStatus($data);

 
    public function delete($data);
}




?>