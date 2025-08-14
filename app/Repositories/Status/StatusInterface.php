<?php

namespace  App\Repositories\Status;

interface StatusInterface
{
    public function index();
    public function create();
    public function store($data);
    public function delete($data);
    public function edit($data);
    public function update($data);
}
