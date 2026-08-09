<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * How long a reset token stays valid, in minutes.
     */
    protected int $tokenExpiryMinutes = 60;

    /**
     * Show the "forgot password" request form.
     *
     * @return \Illuminate\View\View
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    /**
     * Handle the "forgot password" form submission.
     * Generates a token, stores it (hashed), and emails the reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        // Remove any existing reset rows for this email so old tokens
        // (including any previously leaked ones) stop being valid.
        DB::table('password_resets')->where('email', $request->email)->delete();

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            // Store a hash of the token, not the token itself, so a DB leak
            // can't be used to reset accounts directly.
            'token'      => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        // The *unhashed* token is what goes in the email link — the user
        // needs the raw value to prove they own the inbox.
        Mail::send('auth.forgetPasswordEmail', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * Show the reset-password form for a given token.
     *
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Handle the reset-password form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'token'    => 'required|string',
            'email'    => 'required|email|exists:users',
            // 'confirmed' already requires + checks password_confirmation,
            // so no need to validate that field separately.
            'password' => 'required|string|min:6|confirmed',
        ]);

        $resetRow = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$resetRow || !Hash::check($request->token, $resetRow->token)) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        if (Carbon::parse($resetRow->created_at)->addMinutes($this->tokenExpiryMinutes)->isPast()) {
            DB::table('password_resets')->where('email', $request->email)->delete();

            return back()->withInput()->with('error', 'This reset link has expired. Please request a new one.');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('message', 'Your password has been changed!');
    }
}
