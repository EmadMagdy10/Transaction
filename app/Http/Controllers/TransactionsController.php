<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'sendTo' => [
                'required',
                'exists:users,username',
                function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    if ($value === $user->username) {
                        $fail('Sorry, you cannot send funds to your own account.');
                    }
                }
            ],
            'amountTransfer' => ['required', function ($attribute, $value, $fail) {
                $user = Auth::user();
                if ($value > $user->balance) {
                    $fail('Sorry, you do not have sufficient funds.');
                }
            }],
        ],);
        Transactions::create([
            'from_username' => session()->get('user_data')['username'],
            'transaction_amount' => $request->amountTransfer,
            'to_username' => $request->sendTo,
            'last_name' => $request->lastname,
        ]);
        $sender = User::where('id', session('user_data')['id'])->first();
        $sender->balance -= $request->amountTransfer;
        $sender->save();
        $receiver = User::where('username', $request->sendTo)->first();
        $receiver->balance += $request->amountTransfer;
        $receiver->save();

        return redirect()->back()->with('alert', 'done ');
    }
}
