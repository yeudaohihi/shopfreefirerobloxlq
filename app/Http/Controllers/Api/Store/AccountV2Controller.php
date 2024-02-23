<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Models\GroupV2;
use App\Models\ListItemV2;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountV2Controller extends Controller
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

    $group = GroupV2::where('id', $payload['group_id'])->where('status', true)->first();

    if ($group === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy nhóm dịch vụ này',
      ], 400);
    }

    $query = $group->items()->where('status', true);

    if (isset($payload['search'])) {
      if (is_numeric($payload['search'])) {
        $query = $query->where('code', $payload['search']);
      } else {
        // $query = $query->where('name', 'like', '%' . $payload['search'] . '%')
        //   ->orWhere('code', 'like', '%' . $payload['search'] . '%');
        $query = $query->where(function ($q) use ($payload) {
          $q->where('name', 'like', '%' . $payload['search'] . '%')
            ->orWhere('code', 'like', '%' . $payload['search'] . '%');
        });
      }


    }

    if (isset($payload['sort_by'])) {
      $query = $query->orderBy($payload['sort_by'], $payload['sort_type'] ?? 'asc');
    } else {
      $query = $query->orderBy('priority', 'desc')->orderBy('id', 'desc');
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

    $data = $query->skip(($meta['page'] - 1) * $meta['limit'])->take($meta['limit'])->get();

    $data = $data->map(function ($item) {
      $item->makeHidden(['list_image', 'description']);
      return $item;
    });

    // $data = $data->toArray();
    // usort($data, function ($a, $b) {
    //   if ($a['priority'] === $b['priority']) {
    //     return $b['id'] - $a['id'];
    //   }

    //   return $b['priority'] - $a['priority'];
    // });


    return response()->json([
      'data'    => [
        'meta' => $meta,
        'data' => $data,
      ],
      'status'  => 200,
      'message' => 'Lấy danh sách tài khoản thành công',
    ], 200);
  }

  public function show($code)
  {
    $item = ListItemV2::where('code', $code)->first();

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
      'message' => 'Lấy thông tin tài khoản thành công',
    ], 200);
  }

  public function buy(Request $request, $code)
  {
    $item = ListItemV2::where('code', $code)->first();

    if ($item === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy thông tin sản phẩm này',
      ], 400);
    }

    if ($item->status !== true) {
      return response()->json([
        'status'  => 400,
        'message' => 'Sản phẩm này hiện đã bị vô hiệu hoá',
      ], 400);
    }

    $group = $item->group;

    if ($group === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy thông tin nhóm dịch vụ',
      ], 400);
    }

    if (!$group->status) {
      return response()->json([
        'status'  => 400,
        'message' => 'Nhóm dịch vụ này đã bị vô hiệu hoá',
      ], 400);
    }

    $resource = $item->resources()->where('buyer_name', null)
      ->where('buyer_code', null)
      ->first();

    if ($resource === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Sản phẩm này tạm hết tài khoản, vui lòng quay lại sau',
      ], 400);
    }

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

    if (!is_numeric($item->payment) || $item->payment < 0) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không thể tính tiền, vui lòng thử lại',
      ], 400);
    }

    if (!$item->payment) {
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
        'message' => __t('Bạn còn thiếu') . ' ' . Helper::formatCurrency($require) . ' ' . __t('để mua!'),
      ], 400);
    }

    if (!$user->decrement('balance', $item->payment) && $item->payment > 0) {
      return response()->json([
        'status'  => 400,
        'message' => __t('Không thể trừ tiền, vui lòng thử lại'),
      ], 400);
    }

    $code = 'Y2-' . Helper::randomString(8, true);

    $resource->update([
      'domain'     => Helper::getDomain(),
      'buyer_code' => $code,
      'buyer_name' => $user->username,
      'buyer_paym' => $item->payment,
      'buyer_date' => now(),
    ]);

    $group = isset($item->group) ? $item->group->name : '-';

    $user->transactions()->create([
      'code'           => $code,
      'amount'         => $item->payment,
      'cost_amount'    => $item->cost,
      'balance_after'  => $user->balance,
      'balance_before' => $user->balance + $item->payment,
      'type'           => 'account-v2-buy',
      'extras'         => [
        'code'       => $item->code,
        'group_id'   => $item->group_id,
        'account_id' => $item->id,
      ],
      'status'         => 'paid',
      'content'        => '[V2] Mua tài khoản #' . $item->code . '; Nhóm ' . $group,
      'user_id'        => $user->id,
      'username'       => $user->username,
    ]);

    return response()->json([
      'data'    => [
        'code'           => $code,
        'username'       => $item->username,
        'password'       => $item->password,
        'extra_data'     => $item->extra_data,
        'discount'       => $item->discount,
        'original_price' => $item->price,
      ],
      'status'  => 200,
      'message' => 'Mua tài khoản mã số ' . $item->code . ' thành công',
    ], 200);
  }
}
