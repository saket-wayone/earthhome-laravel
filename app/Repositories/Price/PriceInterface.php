<?php 

namespace App\Repositories\Price;

interface PriceInterface{
    public function index();
    public function create();
    public function store($data);
    public function edit($data);
    public function update($data);
    public function delete($data);
}


?>