<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Models\ContactInfo;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * User register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'firstname' => 'required|string|min:2|max:100',
            'lastname' => 'required|string|min:2|max:100',
            'middlename' => 'required|string|min:2|max:100',
            'phone' => 'required|string|min:6|max:100',
            'biling_address' => 'required|string|min:6|max:255'
        ]);
        
        $user = User::create([
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);

        ContactInfo::create([
            'email' => $attr['email'],
            'user_id' => $user->id,
            'firstname' => $attr['firstname'],
            'lastname' => $attr['lastname'],
            'middlename' => $attr['middlename'],
            'phone' => $attr['phone'],
            'biling_address' => $attr['biling_address']
        ]);
        
        // authToken is example
        return $this->success([
            'token' => $user->createToken('authToken')->plainTextToken
        ]);
    }

    /**
     * User login
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        // authToken is example
        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    /**
     * User logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}