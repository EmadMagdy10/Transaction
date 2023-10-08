<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Transactions;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthenticatedSessionController extends Controller

{
    /**
     * Display the login view.
     */



    public function index()
    {
      $user = auth()->user();

      session()->put('user_data', [
        'id' => $user->id,
        'username' => $user->username,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'balance' => $user->balance,
        'email' => $user->email
      ]);
      $transactions = Transactions::where('from_username', $user->username)->orderBy('created_at', 'desc')->paginate(8);

      return view('dashboard')->with( 'userTransaction', $transactions);
    }

    public function create(): View
    {
        return view('auth.login');
    }

public function recieved(){
    $user = auth()->user();

    // $userTransaction = DB::table('transactions')->where('to_username' ,session('user_data')['username'])->paginate(8);
    $transactions = Transactions::where('to_username', $user->username)->orderBy('created_at', 'desc')->paginate(8);

      return view('dashboard')->with( 'userTransaction', $transactions);
}

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
