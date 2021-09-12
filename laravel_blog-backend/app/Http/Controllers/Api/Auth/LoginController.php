<?php
namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
//        $input = $request->all();
//        $input['password'] = bcrypt($input['password']);
//        $user = User::create($input);
//        $success['token'] =  $user->createToken('MyApp')->accessToken;
//        $success['name'] =  $user->name;

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $this->sendError('You cannot sign with those credentials', 'Unauthorised');
        }

        $token = Auth::user()->createToken(config('app.name'));

        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
    }
}
