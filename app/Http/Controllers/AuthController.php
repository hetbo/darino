<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function __construct(protected UserService  $userService) {}

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        $user->sendEmailVerificationNotification();

//        auth()->login($user);

        return $user;

        /** @todo redirect to verify email page (landing) and remove 'return $user;' **/

    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->boolean('remember');

        try {
            if (!$this->userService->login($credentials, $remember)) {
                return response()->json(['message' => __('auth.invalid_credentials')], 401);
/*
                return back()->withErrors([
                    'email' => __('auth.failed')
                ])->withInput($request->except('password'));
*/
            }

            return response()->json([
                'message' => 'Login successful',
                'user' => auth()->user()
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }

        /** @todo get back to login form with errors instead of returning json response **/

    }

    public function logout()
    {
        $this->userService->logout();

        return ['message' => 'logged out'];

        /** @todo later 'return redirect()->route('login');' and remove 'return ['message' => 'logged out'];' **/

    }

    public function verifyEmailNotice()
    {
        return view('auth.verify-email');
    }


    public function verifyEmail(Request $request)
    {
        $userId = $request->route('id');
        $hash = $request->route('hash');

        try {
            $verified = $this->userService->verifyEmail($userId, $hash);

            if (!$verified) {
                return redirect('/email/verify')->with('message', __('auth.email_already_verified'));
            }

            return redirect('/dashboard')->with('success', __('auth.email_verified_success'));

        } catch (\Exception $e) {
            return redirect('/email/verify')->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            $this->userService->sendEmailVerification($user);
        }

        return back()->with('message', __('auth.verification_email_sent_if_exists'));
    }


    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $this->userService->sendPasswordResetLink($request->email);

        return back()->with('message', __('auth.password_reset_sent'));
    }

    public function showResetPasswordForm(Request $request)
    {
        $token = $request->route('token');
        $email = $request->query('email');

        return view('auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $success = $this->userService->resetPassword(
            $request->token,
            $request->email,
            $request->password
        );

        if (!$success) {
            return back()->withErrors(['email' => __('auth.invalid_reset_token')]);
        }

        return redirect('/login')->with('success', __('auth.password_reset_success'));
    }

}
