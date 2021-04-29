<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user);
    }


    protected function loginSuccess($tokenResult, $user)
    {
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(100);
        $token->save();
        return response()->json([
            'status' => 'ok',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user' => $user
        ]);

    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|string|min:8',
            'gender' => 'required|string',
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'address' => $request->address,
                'gender' => $request->gender,
                'is_admin' => 0,
            ]);
            if(!is_null($user)) {
                return response()->json([
                    'message'=>'Success! Registration completed'
                ]);
            }
            else {
                return response()->json([
                    'message'=>'Alert! Failed to register'
                ]);
            }
        } catch (QueryException $q) {
            return $q->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


}
