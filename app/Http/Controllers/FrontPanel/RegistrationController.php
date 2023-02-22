<?php

namespace App\Http\Controllers\FrontPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPanel\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index(): Response
    {
        $title = 'Registration';
        $activeNav = 'Registration';
        return response()->view('FrontPanel.registration', compact('title', 'activeNav'), Response::HTTP_OK);
    }

    public function save(RegistrationRequest $request): JsonResponse
    {
        try {
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->school_attended = $request->get('school_attended');
            $user->about_us = $request->get('about_us');
            $user->for = 'Account Panel';
            $user->status = 'Active';
            $user->save();
            Auth::login($user);
            return response()->json(['message' => 'Registration Successful'], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
