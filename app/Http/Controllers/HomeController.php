<?php

namespace App\Http\Controllers;

use App\Models\User;
use Helper;


class HomeController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $itemCategories      = \App\Models\ItemCategory::where('status', true)->orderBy('priority', 'desc')->get();
    $accountCategories   = \App\Models\Category::where('status', true)->orderBy('priority', 'desc')->get();
    $boostingCategories  = \App\Models\GBCategory::where('status', true)->orderBy('priority', 'desc')->get();
    $accountV2Categories = \App\Models\CategoryV2::where('status', true)->orderBy('priority', 'desc')->get();

    $top10UserDeposit = \App\Models\Transaction::selectRaw('username, sum(amount) as total')
      ->where('type', 'deposit')
      ->groupBy('username')
      ->orderBy('total', 'desc')
      ->whereMonth('created_at', date('m'))
      ->whereYear('created_at', date('Y'))
      ->limit(5)
      ->get();

    // except role admin
    foreach ($top10UserDeposit as $key => $value) {
      $user = User::where('username', $value->username)->first();

      if ($user !== null && $user->role === 'admin') {
        unset($top10UserDeposit[$key]);
      }
    }

    $transactions = \App\Models\Transaction::where('type', 'account-buy')
      ->whereOr('type', 'account-buy-v2')
      ->where('created_at', '>=', now()->subHours(24))
      ->orderBy('id', 'desc')
      ->get();

    $listAccountBuy = "";

    $lang = currentLang();

    if ($lang === 'vn') {
      foreach ($transactions as $transaction) {
        $listAccountBuy .= "<span style=\"color: #504099\">" . Helper::hideUsername($transaction->username) . "</span> " . __t('cách đây') . " <span style=\"color: #E25E3E\">" . Helper::getTimeAgo($transaction->created_at) . "</span> " . __t('đã mua tài khoản') . " <span style=\"color: #279EFF\">#" . ($transaction->extras['code'] ?? $transaction['extras']['account_id'] ?? '-') . "</span> - " . __t('Giá') . " <span style=\"color: #4D2DB7\">" . Helper::formatCurrency($transaction->amount) . "</span> | \n";
      }
    } else {
      foreach ($transactions as $transaction) {
        $listAccountBuy .= "<span style=\"color: #504099\">" . Helper::hideUsername($transaction->username) . "</span> purchased account <span style=\"color: #279EFF\">#" . ($transaction->extras['code'] ?? $transaction['extras']['account_id'] ?? '-') . "</span> <span style=\"color: #E25E3E\">" . Helper::getTimeAgo($transaction->created_at) . "</span> for <span style=\"color: #4D2DB7\">" . Helper::formatCurrency($transaction->amount) . "</span> | \n";
      }
    }

    return view('index', compact('accountCategories', 'accountV2Categories', 'itemCategories', 'boostingCategories', 'top10UserDeposit', 'listAccountBuy'), [
      'pageTitle' => 'Mua Tài Khoản / Vật Phẩm',
    ]);
  }
}
