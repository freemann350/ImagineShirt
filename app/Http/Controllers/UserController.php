<?php

namespace App\Http\Controllers;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
  public function changePasswordStaff() : View
  {
    $user = User::all()->first();
    return view('management.changepassword',compact('user'));
  }

  public function update(PasswordRequest $request, User $user) : RedirectResponse
  {
    if ($request->validated()['password'] != NULL) {
        $user->password = $request->validated()['password'];
        $user->update();
    }

    return back();
  }
}
