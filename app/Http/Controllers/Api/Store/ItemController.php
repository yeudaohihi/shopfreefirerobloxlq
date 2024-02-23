<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Models\ItemData;
use App\Models\ItemGroup;
use App\Models\ItemOrder;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  public function index(Request $request)
  {
    $payload = $request->validate([
      'page'      => 'nullable|integer',
      'limit'     => 'nullable|integer',
      'price'     => 'nullable|string',
      'search'    => 'nullable|string',
      'sort_by'   => 'nullable|string',
      'group_id'  => 'required|integer',
      'sort_type' => 'nullable|string|in:asc,desc',
    ]);

    $group = ItemGroup::where('id', $payload['group_id'])->where('status', true)->first();

    if ($group === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy nhóm dịch vụ này',
      ], 400);
    }

    $query = $group->data()->where('status', true);

    if (isset($payload['search'])) {
      $query = $query->where('name', 'like', '%' . $payload['search'] . '%')
        ->orWhere('code', 'like', '%' . $payload['search'] . '%');
    }

    if (isset($payload['sort_by'])) {
      $query = $query->orderBy($payload['sort_by'], $payload['sort_type'] ?? 'asc');
    } else {
      $query = $query->orderBy('id', 'desc');
    }

    if (isset($payload['price'])) {
      $price = explode('-', $payload['price']);
      if (count($price) === 2) {
        if (is_numeric($price[0]) && is_numeric($price[1])) {
          if ($price[1] <= 0) {
            $query = $query->where('price', '>=', $price[0]);
          } else {
            $query = $query->whereBetween('price', [$price[0], $price[1]]);
          }
        }
      }
    }

    $meta = [
      'page'       => (int) ($payload['page'] ?? 1),
      'limit'      => (int) ($payload['limit'] ?? 10),
      'total_rows' => $query->count(),
      'total_page' => ceil($query->count() / ($payload['limit'] ?? 10)),
    ];

    $data = $query->skip(($meta['page'] - 1) * $meta['limit'])->take($meta['limit']);

    return response()->json([
      'data'    => [
        'meta' => $meta,
        'data' => $data->get(),
      ],
      'status'  => 200,
      'message' => 'Lấy danh sách vật phẩm thành công',
    ], 200);
  }

  public function show($code)
  {
    $item = ItemData::where('code', $code)->first();

    if ($item === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy sản phẩm này',
      ], 400);
    }

    if ($item->is_sold === true) {
      return response()->json([
        'status'  => 400,
        'message' => 'Sản phẩm này đã được bán',
      ], 400);
    }

    return response()->json([
      'data'    => $item,
      'status'  => 200,
      'message' => 'Lấy thông tin vật phẩm thành công',
    ], 200);
  }

  public function buy(Request $request, $code)
  {
    $item = ItemData::where('code', $code)->where('status', true)->first();

    if ($item === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy sản phẩm này',
      ], 400);
    }

    $user = User::find($request->user()?->id);

    if ($user === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không xác thực được thông tin người dùng',
      ], 400);
    }

    if ($item->type === 'addfriend') {
      $payload = $request->validate([
        'Tai_Khoan' => 'required|string',
      ], ['required' => ':attribute không được để trống'], ['Tai_Khoan' => 'Tài khoản']);
    } else if ($item->type === 'user_pass') {
      $message    = [
        'required' => 'Vui lòng nhập :attribute',
        'string'   => ':attribute phải là chuỗi',
      ];
      $attributes = [
        'Mat_Khau'       => 'Mật khẩu',
        'Tai_Khoan'      => 'Tài khoản',
        'Dang_Nhap_Bang' => 'Loại đăng nhập',
      ];
      $payload    = $request->validate([
        'Mat_Khau'       => 'required|string',
        'Tai_Khoan'      => 'required|string',
        'Dang_Nhap_Bang' => 'required|string|in:Riot,Facebook,Google,Roblox,Microsoft,Steam,Other',
      ], $message, $attributes);
    }

    if (!is_numeric($item->payment) || $item->payment <= 0) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không thể tính tiền, vui lòng thử lại',
      ], 400);
    }

    if ($item->payment === 0) {
      $timeWait   = setting('time_wait_free', 10); // seconds
      $lastAction = $user->last_action; // timestamp

      if ($lastAction !== null) {
        $timeDiff = now()->diffInSeconds($lastAction);

        if ($timeDiff < $timeWait) {
          return response()->json([
            'status'  => 400,
            'message' => __t('Bạn cần chờ') . ' ' . ($timeWait - $timeDiff) . ' ' . __t('giây để mua tài khoản miễn phí'),
          ], 400);
        }
      }

      $user->update([
        'last_action' => now(),
      ]);
    }

    if ($user->balance < $item->payment) {
      $require = $item->payment - $user->balance;

      return response()->json([
        'status'  => 400,
        'message' => 'Bạn còn thiếu ' . Helper::formatCurrency($require) . ' để mua!',
      ], 400);
    }

    if (!$user->decrement('balance', $item->payment) && $item->payment > 0) {
      return response()->json([
        'status'  => 400,
        'message' => __t('Không thể trừ tiền, vui lòng thử lại'),
      ], 400);
    }

    $item->update([
      'sold_count' => $item->sold_count + 1,
    ]);


    $order = ItemOrder::create([
      'code'         => 'OG-' . Helper::randomString(8, true),
      'type'         => $item->type,
      'name'         => $item->name,
      'data'         => [
        'id' => $item->id,
      ],
      'payment'      => $item->payment,
      'discount'     => $item->discount,
      'status'       => 'Pending',
      'input_user'   => $payload['Tai_Khoan'] ?? '-',
      'input_pass'   => $payload['Mat_Khau'] ?? '-',
      'input_auth'   => $payload['Dang_Nhap_Bang'] ?? '-',
      'input_ingame' => $item->type === 'addfriend' ? $item->highlights : [],
      'user_id'      => $user->id,
      'username'     => $user->username,
      'admin_note'   => '',
      'order_note'   => 'Tạo đơn hàng thành công',
      'extra_data'   => $payload
    ]);

    $user->transactions()->create([
      'code'           => $order->code,
      'amount'         => $item->payment,
      'balance_after'  => $user->balance,
      'balance_before' => $user->balance + $item->payment,
      'type'           => 'item-buy',
      'extras'         => [
        'group_id'   => $item->group_id,
        'account_id' => $item->id,
      ],
      'status'         => 'paid',
      'content'        => 'Mua dịch vụ ' . $item->name . '; Nhóm ' . $item->group->name,
      'user_id'        => $user->id,
      'username'       => $user->username,
    ]);

    try {
      Helper::sendMail([
        'cc'      => setting('email'),
        'to'      => $user->email,
        'subject' => 'Đơn hàng vật phẩm ' . $order->code . ' của bạn đã được tạo',
        'content' => "Xin chào, <strong>{$user->username}</strong><br><br>Dịch vụ: <strong>{$order->name}</strong><br /><br />Đơn hàng: <strong>{$order->code}</strong> của bạn đã được tạo thành công.<br><br>Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.<br><br>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br><br>Trân trọng,<br><strong>Team " . config('app.name') . "</strong>",
      ]);
    } catch (\Exception $e) {
      // loi
    }

    return response()->json([
      'data'    => [
        'code' => $order->code
      ],
      'status'  => 200,
      'message' => 'Đặt hàng thành công, vui lòng đợi xử lý',
    ], 200);
  }
}
