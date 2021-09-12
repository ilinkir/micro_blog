<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterFormRequest $request)
    {
//        $input = $request->all();
//        $input['password'] = bcrypt($input['password']);
//        $user = User::create($input);
//        $success['token'] =  $user->createToken('MyApp')->accessToken;
//        $success['name'] =  $user->name;
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            ['password' => bcrypt($request->password)],
        ));

        return $this->sendResponse(1, 'User register successfully.');
    }
}
