<?php

namespace App\Http\Controllers\Api\Game;

use App\Http\Controllers\Controller;
use App\Models\SpinQuest;
use App\Models\SpinQuestLog;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class SpinQuestController extends Controller
{
  public function turn(Request $request)
  {
    $payload   = $request->validate([
      'id' => 'required|integer',
    ]);
    $user      = User::findOrFail(auth()->user()->id);
    $unit      = Helper::getConfig('mng_withdraw')['unit'] ?? null;
    $spinQuest = SpinQuest::where('id', $payload['id'])->where('status', true)->firstOrFail();

    if ($user->balance < $spinQuest->price) {
      return response()->json([
        'status'  => 400,
        'message' => 'Số dư không đủ để chơi trò chơi này, vui lòng nạp thêm.',
      ], 400);
    }

    if ($spinQuest->canPlay() !== true) {
      return response()->json([
        'status'  => 400,
        'message' => 'Trò chơi đang bảo trì, vui lòng thử lại sau #1',
      ], 400);
    }

    $result = $spinQuest->playGame();

    if ($result['data'] === null && $result['location'] === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Trò chơi đang bảo trì, vui lòng thử lại sau #2',
      ], 400);
    }

    if (!$user->decrement('balance', $spinQuest->price)) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không thể thực hiện trừ tiền trong tài khoản của bạn #3',
      ], 400);
    }

    $user->transactions()->create([
      'code'           => 'MNG-' . Helper::randomString(7, true),
      'amount'         => $spinQuest->price,
      'cost_amount'    => 0,
      'balance_after'  => $user->balance,
      'balance_before' => $user->balance + $spinQuest->price,
      'type'           => 'play-game',
      'extras'         => [
        'id'   => $spinQuest->id,
        'type' => 'spin-quest',
      ],
      'status'         => 'paid',
      'content'        => "Chơi trò chơi {$spinQuest->name}, rev: {$result['data']['value']} {$unit}",
      'user_id'        => $user->id,
      'username'       => $user->username,
    ]);

    $user->increment('balance_2', $result['data']['value']);

    $content = "Bạn đã nhận được {$result['data']['value']} {$unit} từ trò chơi này!";
    //
    SpinQuestLog::create([
      'unit'          => $unit,
      'prize'         => $result['data']['value'],
      'price'         => $spinQuest->price,
      'status'        => 'Completed',
      'content'       => $content,
      'user_id'       => $user->id,
      'username'      => $user->username,
      'spin_quest_id' => $spinQuest->id,
    ]);

    return response()->json([
      'status'   => 200,
      'message'  => $content,
      'location' => $result['location'] ?? null,
    ]);
  }
}
