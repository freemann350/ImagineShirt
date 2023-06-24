<?php

namespace App\Http\Controllers;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
  public function changePasswordStaff() : View
  {
    return view('management.changepassword');
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
