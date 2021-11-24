<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password)
        {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }

    public function addFunds(Request $request): RedirectResponse
    {
        $topUp = $request->get('topup-amount');
        if ($topUp > 0)
        {
            auth()->user()->deposit($topUp);

            return redirect()->back()->with('success', 'Funds added.');
        }
        return redirect()->back()->with('error', 'Invalid amount provided!');
    }
}
