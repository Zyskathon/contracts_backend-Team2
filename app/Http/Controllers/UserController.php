<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = Request::create('/oauth/token', 'POST', $request->all());
        $response = app()->handle($data);
        if (!$response->isSuccessful()) {
            return response('Invalid credentials', 400);
        }
        $responseData = json_decode($response->getContent(), true);
        $user = User::where('email', $request->username)->first();
        $responseData['role'] = $user->role->name;
        $responseData['username'] = $user->first_name. ' '. $user->last_name;
        $response->setContent(json_encode($responseData));

        return $response; //what if the user is not there?
    }

    public function userDetails(Request $request)
    {
        return new UserResource($request->user());
    }
}
