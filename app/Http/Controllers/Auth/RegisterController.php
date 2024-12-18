<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\UseCases\RegisterUser\RegisterUserDto;
use App\UseCases\RegisterUser\RegisterUserUseCase;

class RegisterController extends Controller
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function create(RegisterUserRequest $request)
    {
        $response = $this->registerUserUseCase->execute(
            new RegisterUserDto(
                $request->name,
                $request->email,
                $request->password,
                $request->password_confirmation
            )
        );

        if ($response->outcome) {
            return redirect()->route('register.index')
                ->with('success', $response->message);
        }

        if(!$response->outcome) {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function store(RegisterUserRequest $request)
    {
        $response = $this->registerUserUseCase->execute(
            new RegisterUserDto(
                $request->name,
                $request->email,
                $request->password,
                $request->password_confirmation
            )
        );
        return response()->json($response);
    }
}
