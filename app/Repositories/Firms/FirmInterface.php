<?php 

namespace App\Repositories\Firms;

interface FirmInterface{
    public function index();
    public function create();
    public function store($data);
    public function delete($data);
    public function edit($data);
    public function update($data);

}


?>