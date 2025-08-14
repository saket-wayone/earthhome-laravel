<?php 
namespace App\Repositories\Mr;

interface MrInterface{
    public function index();
    public function history();
    public function create();
    public function license();
    public function notused();
    public function purchasecredit($data);
    public function renewupdate($data);
    public function chhosedplan($request);
    public function companychhosedplan($request);
    public function renew($data);
    public function edit($id);
    public function update($data);
    public function paused($id);
    public function pausedmr($request);
}

?>
