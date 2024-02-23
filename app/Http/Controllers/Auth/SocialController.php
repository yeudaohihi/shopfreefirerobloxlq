<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Helper;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
  public function redirectToProvider($provider)
  {
    $config = Helper::getApiConfig('auth_' . $provider);

    if ($config) {
      config([
        'services.' . $provider . '.active' => true,
        'services.' . $provider . '.client_id' => $config['client_id'],
        'services.' . $provider . '.client_secret' => $config['client_secret'],
        'services.' . $provider . '.redirect' => route('social.callback', ['provider' => $provider]),
      ]);
    }
    return Socialite::driver($provider)->redirect();
  }

  public function handleProviderCallback($provider)
  {
    $user = Socialite::driver($provider);

    try {
      $user = $user->user();
    } catch (\Exception $e) {
      return redirect()->route('login')->withErrors([
        'username' => 'Đăng nhập bằng ' . $provider . ' thất bại',
      ]);
    }

    $userExists = User::where('username', $user->id)->first();

    if ($userExists) {

      if (!$userExists->access_token) {
        $userExists->update([
          'access_token' => explode('|', $userExists->createToken('access_token')->plainTextToken)[1],
        ]);
      }

      Auth::login($userExists);

      Helper::addHistory('Đăng nhập bằng ' . $provider . ' thành công');

      return redirect()->intended(route('home'));
    }

    $emailExists = User::where('email', $user->email)->first();

    if ($emailExists) {
      return redirect()->route('register')->withErrors([
        'email' => 'Email này đã được sử dụng bởi tài khoản khác',
      ]);
    }

    $newUser = User::create([
      'role'          => 'user',
      'email'         => $user->email ?? ($user->id . '@' . $provider . '.com'),
      'avatar'        => $user->avatar,
      'username'      => $user->nickname ?? $user->id,
      'fullname'      => $user->name,
      'password'      => bcrypt($user->id) . '_baoinc' . mt_rand(400, 500),
      'ip_address'    => request()->ip(),
      'register_by'   => strtoupper($provider),
      'referral_code' => str()->random(12),
    ]);

    if (!$newUser->access_token) {
      $newUser->update([
        'access_token' => explode('|', $newUser->createToken('access_token')->plainTextToken)[1],
      ]);
    }

    Auth::login($newUser);

    Helper::addHistory('Đăng ký tài khoản bằng ' . $provider . ' thành công');

    return redirect()->intended(route('home'));
  }
}