<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Socialite;
use App\User;

final class OauthController extends Controller
{
  public function redirectProvider()
  {
    return Socialite::driver('github')->redirect();
  }
  public function handleProviderCallback()
  {
    $user = Socialite::driver('github')->user();
    \Auth::login(
      User::firstOrCreate([
        'name' => $user->getName(),
        'email' => $user->getEmail(),
      ]),
      true
      );
      return redirect('/home');
  }
}
