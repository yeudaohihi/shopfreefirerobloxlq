<?php

namespace App\Http\Controllers\Admin\Game;

use App\Http\Controllers\Controller;
use App\Models\SpinQuest;
use Helper;
use Illuminate\Http\Request;

class SpinQuestController extends Controller
{
  public function index()
  {
    $spinQuests = SpinQuest::all();

    return view('admin.game.spin-quest.index', compact('spinQuests'));
  }

  public function store(Request $request)
  {
    $payload = $request->validate([
      'name'   => 'required|string',
      'cover'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
      'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
      'price'  => 'required|integer',
      'status' => 'required|boolean'
    ]);

    if ($request->has('cover')) {
      $payload['cover'] = Helper::uploadFile($request->file('cover'), 'imgur');
    }

    if ($request->has('image')) {
      $payload['image'] = Helper::uploadFile($request->file('image'), 'imgur');
    }

    $payload['prizes'] = [];

    $spin = SpinQuest::create($payload);

    Helper::addHistory("Tạo vòng quay mới ($spin->name)");

    return redirect()->back()->with('success', 'Tạo vòng quay thành công');
  }

  public function show($id)
  {
    $spinQuest = SpinQuest::findOrFail($id);

    return view('admin.game.spin-quest.show', compact('spinQuest'));
  }


  public function update(Request $request)
  {
    $payload = $request->validate([
      'id'       => 'required|integer',
      'name'     => 'required|string',
      'type'     => 'required|string',
      'cover'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
      'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
      'descr'    => 'nullable|string',
      'price'    => 'required|integer',
      'status'   => 'required|boolean',
      'store_id' => 'nullable|integer',
    ]);

    $spinQuest = SpinQuest::findOrFail($payload['id']);

    if ($request->has('cover')) {
      $payload['cover'] = Helper::uploadFile($request->file('cover'), 'imgur');
    } else {
      $payload['cover'] = $spinQuest->cover;
    }

    if ($request->has('image')) {
      $payload['image'] = Helper::uploadFile($request->file('image'), 'imgur');
    } else {
      $payload['image'] = $spinQuest->image;
    }

    $payload['descr'] = Helper::htmlPurifier($payload['descr']);

    $spinQuest->update($payload);

    Helper::addHistory("Cập nhật vòng quay ($spinQuest->name)");

    return redirect()->back()->with('success', 'Cập nhật vòng quay thành công');
  }

  public function updatePrize(Request $request)
  {
    $payload = $request->validate([
      'id'     => 'required|integer',
      'prizes' => 'required|array'
    ]);

    $spinQuest = SpinQuest::findOrFail($payload['id']);

    $spinQuest->update(
      ['prizes' => $payload['prizes']]
    );

    Helper::addHistory("Cập nhật giải thưởng vòng quay ($spinQuest->name)");

    return redirect()->back()->with('success', 'Cập nhật giải thưởng thành công');
  }
}
