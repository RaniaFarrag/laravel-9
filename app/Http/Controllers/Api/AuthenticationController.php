<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseController
{
    public $authenticationService;

    public function __construct(AuthenticationService $authenticationService){
        $this->authenticationService = $authenticationService;
    }

    public function register(CreateUserRequest $createUserRequest){

        $user = $this->authenticationService->createUser($createUserRequest->all());
        $data['user'] = $user;
        $data['token'] = $user->createToken('my-token')->plainTextToken;

        return $this->sendResponse($data);
    }

    public function login(LoginRequest $loginRequest){
        if (Auth::attempt(['email'=>$loginRequest->all()['email'], 'password'=>$loginRequest->all()['password']])){
            $data['user'] = Auth::user();
            $data['token'] = Auth::user()->createToken('my-token')->plainTextToken;

            return $this->sendResponse($data);
        }
        else{
            return $this->sendResponse('Failure', 'faild', 401);
        }
    }

    public function logout(){
        Auth::user()->tokens()->delete();

        return $this->sendResponse('');
    }
}
