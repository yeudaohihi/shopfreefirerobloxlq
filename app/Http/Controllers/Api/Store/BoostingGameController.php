<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Models\GBGroup;
use App\Models\GBOrder;
use App\Models\GBPackage;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class BoostingGameController extends Controller
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

    $group = GBGroup::where('id', $payload['group_id'])->where('status', true)->first();

    if ($group === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy nhóm dịch vụ này',
      ], 400);
    }

    $query = $group->packages()->where('status', true);

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
      'message' => 'Lấy danh sách dịch vụ thành công',
    ], 200);
  }

  public function buy(Request $request, $code)
  {
    $package = GBPackage::where('code', $code)->first();

    if ($package === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy thông tin sản phẩm này',
      ], 400);
    }

    $payload = $request->validate([
      'order_note'  => 'nullable|string',
      'input_user'  => 'required|string',
      'input_pass'  => 'required|string',
      'input_extra' => 'nullable|string',
    ]);

    $user = User::find($request->user()?->id);

    if ($user === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không xác thực được thông tin người dùng',
      ], 400);
    }

    if ($user->status !== 'active') {
      return response()->json([
        'status'  => 400,
        'message' => 'Tài khoản của bạn đã bị vô hiệu hoá',
      ], 400);
    }

    if (!is_numeric($package->price) || $package->price <= 0) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không thể tính tiền, vui lòng thử lại',
      ], 400);
    }

    if ($user->balance < $package->price) {
      $require = $package->price - $user->balance;

      return response()->json([
        'status'  => 400,
        'message' => 'Bạn còn thiếu ' . Helper::formatCurrency($require) . ' để mua!',
      ], 400);
    }

    if (!$user->decrement('balance', $package->price)) {
      return response()->json([
        'status'  => 400,
        'message' => 'Có lỗi xảy ra, vui lòng thử lại sau',
      ], 400);
    }

    $code = 'GB-' . Helper::randomString(8, true);


    $order = GBOrder::create([
      'name'        => $package->name,
      'code'        => $code,
      'input_user'  => $payload['input_user'],
      'input_pass'  => $payload['input_pass'],
      'input_extra' => $payload['input_extra'] ?? '',
      'payment'     => $package->price,
      'status'      => 'Pending',
      'user_id'     => $user->id,
      'username'    => $user->username,
      'package_id'  => $package->id,
      'group_id'    => $package->group_id,
      'order_note'  => $payload['order_note'] ?? '',
    ]);

    $package->update([
      'sold_count' => $package->sold_count + 1,
    ]);

    $group = isset($package->group) ? $package->group->name : '-';

    $user->transactions()->create([
      'code'           => $code,
      'amount'         => $package->price,
      'balance_after'  => $user->balance,
      'balance_before' => $user->balance + $package->price,
      'type'           => 'boosting-buy',
      'extras'         => [
        'group_id'   => $package->group_id,
        'package_id' => $package->id,
      ],
      'status'         => 'paid',
      'content'        => 'Thuê gói cày ' . $package->name . '; Nhóm ' . $group,
      'user_id'        => $user->id,
      'username'       => $user->username,
    ]);


    try {
      Helper::sendMail([
        'cc'      => setting('email'),
        'to'      => $user->email,
        'subject' => 'Đơn hàng cày thuê ' . $order->code . ' của bạn đã được tạo',
        'content' => "Xin chào, <strong>{$user->username}</strong><br><br>Dịch vụ: <strong>{$order->name}</strong><br /><br />Đơn hàng: <strong>{$order->code}</strong> của bạn đã được tạo thành công.<br><br>Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.<br><br>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br><br>Trân trọng,<br><strong>Team " . config('app.name') . "</strong>",
      ]);
    } catch (\Exception $e) {
      // loi
    }

    return response()->json([
      'data'    => [
        'code'    => $code,
        'name'    => $package->name,
        'payment' => $package->price,
      ],
      'status'  => 200,
      'message' => 'Tạo đơn hàng thành công, vui lòng đợi',
    ], 200);
  }
}
