<?php

namespace App\Http\Controllers\admin\validate;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthPostRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPassword;
use App\Repositories\Auth\AuthInterface;
use Illuminate\Http\Request;

use App\Http\Requests\UserCreateRequest;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public  function index(){
        return  $this->authRepository->index();
    }
    public  function signup(){
        return  $this->authRepository->signup();
    }
    public  function registercompanyadmin(UserCreateRequest $request){
        return  $this->authRepository->registercompanyadmin($request->all());
    }

    // validate user function

    public function validateuser(AuthPostRequest $request){
        // validate the email and password
        return $this->authRepository->validateusers($request->all());
    }
    public function forgotpassword(ForgotPasswordRequest $request){
        // validate the email and password
        return $this->authRepository->forgotpassword($request->all());
    }
    public function resetpassword(ResetPassword $request){
        // validate the email and password
        return $this->authRepository->resetpassword($request->all());
    }


    public function forgot(){
        return  $this->authRepository->forgot();
    }

    public function loggedIn(Request $request){
        return  $this->authRepository->loggedIn($request->id);
    }
}
