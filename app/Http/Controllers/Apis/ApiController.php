<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instrument;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'token' => $token
            ], 200);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Invalid credentials'
        ], 401);
    }

    function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'bandname' => 'required',
            'mail' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'bandname' => $request->input('bandname'),
            'email' => bcrypt($request->input('mail')),
            'password' => $request->input('password'), 
        ]);

        Auth::login($user);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status' => 201,
            'token' => $token,
        ], 201);
    }

    function index() {
        try {
            $user = Auth::user();
            
            $player = Instrument::all();
            
        if($player->count() > 0) {
            return response()->json([
                'status' => 200,
                'instruments' => $player,
            ], 200 );
        } else {
            return response()->json([
                'status' => 404,
                'instruments' => 'No instruments found',
            ], 404);
        }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 401,
                'error' => 'Invalid token'
            ], 401);
        }
    }

    function show($id) {
        try {
            $user = Auth::user();
            $player = Instrument::where('id', $id)->get();
            if(!$player->isEmpty()) {
                return response()->json([
                    'status' => 200,
                    'instrument' => $player,
                ], 200 );
            } else {
                return response()->json([
                    'status' => 404,
                    'instrument' => 'Not founded',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 401,
                'error' => 'Invalid token'
            ], 401);
        }
    }
}
