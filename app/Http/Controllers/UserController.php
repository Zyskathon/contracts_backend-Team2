<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = Request::create('/oauth/token', 'POST', $request->all());
        $response = app()->handle($data);
        if (!$response->isSuccessful()) {
            return response('Invalid credentials', 401);
        }
        return $response; //what if the user is not there?
    }
}
