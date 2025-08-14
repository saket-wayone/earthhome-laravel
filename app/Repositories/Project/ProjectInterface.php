<?php

namespace App\Repositories\Project;;

interface ProjectInterface
{
    public function index();
    public function detail($id);
    public function getbalance($id);
    public function updatepayment($request);
}
