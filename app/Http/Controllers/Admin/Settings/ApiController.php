<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\ApiConfig;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function index()
  {
    $apis = [];

    foreach (ApiConfig::all() as $item) {
      $apis[strtolower($item->name)] = $item->value;
    }

    return view('admin.settings.apis', $apis);
  }

  public function update(Request $request)
  {
    $type  = $request->input('type', null);
    $value = [];

    if (in_array($type, ['web2m_vietcombank', 'web2m_mbbank', 'web2m_acb'])) {
      $value = $request->validate([
        'api_token'        => 'nullable|string|max:255',
        'account_number'   => 'nullable|string|max:255',
        'account_password' => 'nullable|string|max:255',
      ]);
    } elseif ($type === 'charging_card') {
      $value = $request->validate([
        'fees'        => 'nullable|array',
        'api_url'     => 'nullable|url|max:255',
        'partner_id'  => 'nullable|string|max:255',
        'partner_key' => 'nullable|string|max:255',
      ]);
    } elseif ($type === 'smtp_detail') {
      $value = $request->validate([
        'host' => 'nullable|string|max:255',
        'port' => 'nullable|integer|max:65535',
        'user' => 'nullable|string|max:255',
        'pass' => 'nullable|string|max:255',
      ]);
    } elseif ($type === 'web2m_momo') {
      $value = $request->validate([
        'api_token' => 'nullable|string|max:255',
      ]);
    } else if (in_array($type, ['auth_facebook', 'auth_google'])) {
      $value = $request->validate([
        'client_key'    => 'nullable|string|max:255',
        'client_secret' => 'nullable|string|max:255',
      ]);
    } else if ($type === 'fpayment') {
      $value = $request->validate([
        'exchange'       => 'required|integer',
        'token_wallet'   => 'required|string',
        'address_wallet' => 'required|string',
      ]);
    } else if ($type === 'perfect_money') {
      $value = $request->validate([
        'exchange'   => 'required|integer',
        'account_id' => 'required|string',
        'passphrase' => 'required|string',
      ]);
    } else if ($type === 'paypal') {
      $value = $request->validate([
        'exchange'      => 'required|integer',
        'client_id'     => 'required|string',
        'client_secret' => 'required|string',
      ]);
    } else {
      return redirect()->back()->with('error', 'Cấu hình API không tồn tại.');
    }

    $config = ApiConfig::firstOrCreate(['name' => $type], ['value' => []]);

    $config->update([
      'value' => $value,
    ]);

    return redirect()->back()->with('success', 'Cập nhật API thành công [' . $type . '].');
  }
}
