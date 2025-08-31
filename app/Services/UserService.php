<?php

namespace App\Services;

use App\Exceptions\EmailNotVerifiedException;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService {

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        if (!Auth::attempt($credentials, $remember)) {
            return false;
        }

        $user = Auth::user();

        if (!$user->email_verified_at) {
            Auth::logout();
            throw new EmailNotVerifiedException();
        }

        return true;
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function sendEmailVerification(User $user): void
    {
        if ($user->hasVerifiedEmail()) {
            throw new \Exception(__('auth.email_already_verified'));
        }

        $user->sendEmailVerificationNotification();
    }


    public function verifyEmail(int $userId, string $hash): bool
    {
        $user = User::findOrFail($userId);

        if ($user->hasVerifiedEmail()) {
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            throw new \Exception(__('auth.invalid_verification_link'));
        }

        $user->markEmailAsVerified();

        return true;
    }

    public function sendPasswordResetLink(string $email): bool
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $token = Str::random(64);

            // Store reset token
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'token' => Hash::make($token),
                    'created_at' => now()
                ]
            );

            Mail::to($user)->send(new PasswordResetMail($user, $token));
        }

        return true;
    }

    public function resetPassword(string $token, string $email, string $password): bool
    {
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$resetRecord || !Hash::check($token, $resetRecord->token)) {
            return false;
        }

        if (now()->diffInMinutes($resetRecord->created_at) > 60) {
            return false;
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return false;
        }

        $user->update(['password' => Hash::make($password)]);

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return true;
    }


}
