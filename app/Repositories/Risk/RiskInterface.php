<?php 

namespace App\Repositories\Risk;

interface RiskInterface{
    public function index();
    public function create();
    public function download($data);
    public function download2 ($data);
    public function delete($data);
    public function edit($data);
    public function checkmobile($data);
    public function filter($data);

}



?>