<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthController extends Controller
{
    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->middleware('auth:sanctum', ['except' => ['register', 'login']]);
        $this->userRepository = $userRepository;
    }
    
    public function register()
    { 
        $requestData = request()->only(['email', 'password', 'name']);
        
        $rules = [ 
            'email'            => 'required|unique:users|email|max:255',
            'password'         => 'required|min:8|max:255',
            'name'             => 'required|max:255|regex:/^[a-zA-Z0-9 _.-]*$/',
        ];
        
        $validator = \Validator::make($requestData, $rules);
        
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        
        $user =  $this->userRepository->add($requestData);
        
        return response()->json(['token' => $user->createToken('API Token')->plainTextToken]);
    }
    
    public function login()
    {        
        $credentials = request(['email', 'password']);
        
        $rules = [
            'email'        => 'required|email|max:255',
            'password'     => 'required|min:8|max:255',
        ];
        
        $validator = \Validator::make($credentials, $rules);
        
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Wrong credentials.'], 401);
        }

        return response()->json(['token' => auth()->user()->createToken('API Token')->plainTextToken]);
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['success' => 'You are logged out'], 200);
    }
}
