<?php

namespace  App\Repositories\Banner;

interface BannerInterface
{
    public function index();
    public function create();
    public function store($data);
    public function delete($data);
    public function edit($data);
    public function update($data);
}
