<?php 
namespace App\Repositories\User;

interface  UserInterface {
    public  function index($data);
    public  function create();
    public  function all();
    public  function store($data);
    public  function delete($data);
    public  function edit($data);
    public  function update($data);
    public  function statusmethod($data);
    public  function viewmr($id);
    public  function myteam();
    public  function changepassword();
}











?>