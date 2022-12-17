<?php


namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request)
    {
        $data =$this->userService->storeUser($request->all());
        return $this->response($data,Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $user =$this->userService->login($request->all());
        abort_if(!$user,404,"User with the email not found");

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Personal Access Token');

            return $this->response([
                'user' => $user,
                'access_token' =>  $token->accessToken,

            ], Response::HTTP_OK);
        }
        return $this->response([], Response::HTTP_UNAUTHORIZED);
    }

    public function profile()
    {
        $data = auth()->user();
        return $this->response($data,Response::HTTP_OK);
    }
}
