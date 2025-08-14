<?php 

namespace App\Repositories\Service;

interface ServiceInterface{
    public function index();
    public function expired();
    public function create($id);
    public function edit($id);
    public function deleteserviceagreement($data);
    public function delete($data);
    public function store($data);
    public function viewscore($data);
    public function score($data);
    public function update($data);
    public function viewserviceaggrement($data);

}



?>