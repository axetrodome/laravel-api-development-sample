<?php

namespace App\Http\Controllers;
// tomodachi@o3enzyme.com
use App\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Http\Requests\StoreUserRequest;

class RegisterController extends Controller
{
    //
    public function register(StoreUserRequest $request)
    {
    	$user = new User;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	return fractal()
    		->item($user, new UserTransformer)
    		->toArray();
    }
}
