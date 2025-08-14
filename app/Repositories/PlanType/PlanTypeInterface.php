<?php

namespace  App\Repositories\PlanType;

interface PlanTypeInterface
{
    public function index();
    public function create();
    public function store($data);
    public function delete($data);
    public function edit($data);
    public function update($data);
}
