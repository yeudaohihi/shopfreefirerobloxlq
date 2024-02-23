<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  public function index($slug)
  {
    $group = \App\Models\ItemGroup::where('status', true)->where('slug', $slug)->firstOrFail();

    return view('store.item', compact('group'), [
      'pageTitle' => 'Xem sản phẩm ' . $group->name,
    ]);
  }

}