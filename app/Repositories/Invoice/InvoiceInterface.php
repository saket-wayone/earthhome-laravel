<?php

namespace App\Repositories\Invoice;

interface InvoiceInterface
{

    public function index();
    public function create();
    public function view($id);
    public function store($data);
    public function update($data);
    public function delete($data);
    public function edit($data);
    public function filter($data);
}
