<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // ✅ Tambahkan import ini

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Debug method
    protected function authenticated(Request $request, $user)
    {
        Log::info('User logged in: ' . $user->email); // ✅ Tanpa backslash
        Log::info('Redirecting to: ' . $this->redirectTo);

        return redirect()->intended($this->redirectTo);
    }
}
