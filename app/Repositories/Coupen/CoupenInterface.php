<?php 

namespace App\Repositories\Coupen;

interface CoupenInterface
{
    public function index();
    public function create();
    public function store($data);
    public function delete($data);
    public function edit($data);
    public function update($data);
    public function applycoupen($data);

}

?>