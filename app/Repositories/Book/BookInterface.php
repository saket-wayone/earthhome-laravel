<?php 

namespace  App\Repositories\Book;


interface BookInterface
{
    public function index();
    public function notify();
    public function create();
    public function createpage($id);
    public function showpage($id);
    public function store($data);
    public function update($data);
    public function edit($id);
    public function pagedit($id);
    public function addnew($id);
    public function deletepage($data);
    public function delete($data);
    public function move($data);
}


?>