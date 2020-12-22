<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Employee;

Route::get('me', function () {
    // middleware check auth from redis
    if(!RedisManager::get('session')) {
        return response()->json(['message' => 'Unauthorized'], 401); 
    }

    return response()->json(['data' => RedisManager::get('session')], 200);
});

Route::get('employees', function () {
    // middleware check auth from RedisManager
    if(!RedisManager::get('session')) {
        return response()->json(['message' => 'Unauthorized'], 401); 
    }
    // return all employees
    $employees = Employee::all();

    return response()->json($employees, 200);
});

Route::post('login', function (Request $request) {
    // login 
    $creds = $request->only('email', 'password');

    if(Auth::attempt($creds)) {
        //add to RedisManager session
        RedisManager::set('session', $creds['email']);

        return response()->json([
            'message' => 'Login success',
            'data' => RedisManager::get('session'),
        ], 200);

        return response()->json('Logged in', 200);
    }

    return response()->json([
        'message' => 'Login failed'
    ], 401);
});

Route::get('logout', function () {

    RedisManager::del('session');

    return response()->json([
        'message' => 'Logout success'
    ], 200);
});
