<?php

namespace App\Http\Controllers\FrontPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPanel\ForgotPasswordRequest;
use App\Http\Requests\FrontPanel\ForgottenPasswordRequest;
use App\Mail\FrontPanel\ForgotPasswordMail;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index(): Response
    {
        $title = 'Forgot Password';
        $activeNav = 'Forgot Password';
        return response()->view('FrontPanel.forgot_password', compact('title', 'activeNav'), Response::HTTP_OK);
    }

    public function verify(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->email)->first();
            $verificationCode = mt_rand(100000, 999999);
            $user->verification_token = sha1($verificationCode);
            $user->verification_code = $verificationCode;
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return response()->json(['payload' => $user], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
