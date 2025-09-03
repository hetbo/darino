<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailNotVerifiedException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/** @final Authentication Flow is Complete **/
class AuthController extends Controller {

    public function __construct(protected UserService  $userService) {}

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        $user->sendEmailVerificationNotification();

        $signedUrl = URL::signedRoute('verification.notice', now()->addMinutes(60));

        return redirect($signedUrl);
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->only(['email', 'password']);
        $remember = $request->boolean('remember');

        try {

            if (!$this->userService->login($credentials, $remember)) {

                return back()->withErrors([
                    'email' => __('auth.invalid_credentials')
                ])->withInput($request->except('password'));

            }

            return redirect()->route('dashboard');

        } catch (EmailNotVerifiedException $e) {
            return redirect(URL::temporarySignedRoute('verification.notice', now()->addMinutes(60)));
        }
    }

    public function logout()
    {
        $this->userService->logout();

        return redirect('login');

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
