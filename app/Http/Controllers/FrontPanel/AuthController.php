<?php

namespace App\Http\Controllers\FrontPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index(): Response
    {
        $title = 'Login';
        $activeNav = 'Login';
        return response()->view('FrontPanel.auth', compact('title', 'activeNav'), Response::HTTP_OK);
    }

    public function authenticate(Request $request) : JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'for' => 'Account Panel', 'status' => 'Active'], (int)$request->remember_me)) {
                $request->session()->regenerate();
                return response()->json(['message' => 'Authorized Access'], Response::HTTP_OK);
            }
            return response()->json(['message' => 'Unauthorized Access!'], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->user();
            $dbUser = User::where('provider_id', $user->id)->where('provider_name', 'Google')->first();
            if($dbUser) {
                Auth::login($dbUser);
                return redirect()->intended('/account/panel/essay');
            } else {
                $newUser = User::create([
                    'provider_name' => 'Google',
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'password' => encrypt('123456'),
                    'for' => 'Account Panel',
                    'status' => 'Active'
                ]);
                Auth::login($newUser);
                return redirect()->intended('/account/panel/essay');
            }
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            return Redirect::to('login');
        }
    }


    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $dbUser = User::where('provider_id', $user->id)->where('provider_name', 'Facebook')->first();
            if($dbUser) {
                Auth::login($dbUser);
                return redirect()->intended('/account/panel/essay');
            } else {
                $newUser = User::create([
                    'provider_name' => 'Facebook',
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'password' => encrypt('123456'),
                    'for' => 'Account Panel',
                    'status' => 'Active'
                ]);
                Auth::login($newUser);
                return redirect()->intended('/account/panel/essay');
            }
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            return Redirect::to('login');
        }
    }




    public function logout(): RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');

    }





    public function controlPanelLogin(): Response
    {
        $title = 'Control Panel Login';
        return response()->view('FrontPanel.control_panel_auth', compact('title'), Response::HTTP_OK);
    }

    public function authenticateControlPanelLogin(Request $request) : JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'for' => 'Control Panel', 'status' => 'Active'], (int)$request->remember_me)) {
                $request->session()->regenerate();
                return response()->json(['message' => 'Authorized Access'], Response::HTTP_OK);
            }
            return response()->json(['message' => 'Unauthorized Access!'], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logoutControlPanel(): RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/control/panel/login');

    }
}
