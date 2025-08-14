<?php 

namespace App\Repositories\Auth;

// creating interface
interface AuthInterface {
    public function index();
    public function signup();
    public function validateusers($data);
    public function forgotpassword($data);
    public function resetpassword($data);
    public function forgot();
    public function registercompanyadmin($data);
    public function loggedIn($data);
}




?>