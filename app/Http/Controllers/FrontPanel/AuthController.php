<?php

namespace App\Http\Controllers\FrontPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
