<?php

namespace App\Http\Controllers\FrontPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPanel\ResetPasswordRequest;
use App\Http\Requests\FrontPanel\ResettingPasswordRequest;
use App\Mail\FrontPanel\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function index($verificationToken)
    {
        if (User::where('verification_token', $verificationToken)->first()) {
            $title = 'Reset Password';
            $activeNav = 'Reset Password';
            return response()->view('FrontPanel.reset_password', compact('title', 'verificationToken', 'activeNav'), Response::HTTP_OK);
        } else {
            return response()->view('errors.FrontPanel.404', ['title' => '404'], Response::HTTP_NOT_FOUND);
        }
    }

    public function verify(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $user = User::where('verification_token', $request->verification_token)->first();
            $user->password = Hash::make($request->password);
            $user->verification_token = null;
            $user->verification_code = null;
            $user->save();
            return response()->json(['message' => 'Password Reset Successfully', 'payload' => $user], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function resend(Request $request): JsonResponse
    {
        try {
            $user = User::where('verification_token', $request->verification_token)->first();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return response()->json(['message' => 'Resending Verification Code Successful', 'payload' => $user], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
