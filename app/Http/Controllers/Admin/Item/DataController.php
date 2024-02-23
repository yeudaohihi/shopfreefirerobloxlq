<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Models\ItemGroup;
use App\Models\ItemData;
use Helper;
use Illuminate\Http\Request;

class DataController extends Controller
{
  public function index(Request $request, $id = null)
  {
    $group = ItemGroup::findOrFail($id);

    return view('admin.items.data.index', compact('group'));
  }

  public function store(Request $request)
  {
    $payload = $request->validate([
      'id'          => 'required|exists:item_groups,id',
      'type'        => 'required|string|in:user_pass,addfriend',
      'name'        => 'required|string',
      'code'        => 'nullable|integer',
      'price'       => 'required|integer',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
      'discount'    => 'required|integer',
      'status'      => 'required|boolean',
      'highlights'  => 'required|string',
      'description' => 'required|string',
    ]);

    $group = ItemGroup::findOrFail($payload['id']);

    $payload['group_id'] = $group->id;

    if ($request->hasFile('image')) {
      $payload['image'] = Helper::uploadFile($request->file('image'), 'public', 'items/' . $group->id);
    }

    $highlights = explode(PHP_EOL, $payload['highlights']);
    $highlights = array_map(function ($item) {
      return trim($item);
    }, $highlights);

    $payload['highlights'] = ($highlights);

    $autoCode = true;
    if (!empty($payload['code'])) {
      $autoCode = false;
    }

    $payload['code'] = $autoCode ? ItemData::generateCode() : $payload['code'];

    $data = ItemData::create($payload);

    Helper::addHistory('[ITEMS] Thêm sản phẩm ' . $data->name . ' vào nhóm ' . $group->name);

    return redirect()->back()->with('success', 'Thêm sản phẩm vào nhóm thành công');
  }

  public function show($id)
  {
    $item = ItemData::findOrFail($id);

    return view('admin.items.data.show', compact('item'));
  }

  public function update(Request $request)
  {
    $payload = $request->validate([
      'id'          => 'required|exists:item_data,id',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
      'code'        => 'nullable|integer|unique:item_data,code,' . $request->id . ',id',
      'type'        => 'required|string|in:user_pass,addfriend',
      'name'        => 'required|string',
      'price'       => 'required|integer',
      'discount'    => 'required|integer',
      'status'      => 'required|boolean',
      'highlights'  => 'required|string',
      'description' => 'required|string',
    ]);

    $item = ItemData::findOrFail($payload['id']);

    if ($request->hasFile('image')) {
      $payload['image'] = Helper::uploadFile($request->file('image'), 'public', 'items/' . $item->group_id);
    }

    $highlights = explode(PHP_EOL, $payload['highlights']);
    $highlights = array_map(function ($item) {
      return trim($item);
    }, $highlights);

    $payload['highlights'] = ($highlights);

    $item->update($payload);

    Helper::addHistory('[ITEMS] Cập nhật sản phẩm ' . $item->name);

    return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
  }

  public function delete(Request $request)
  {
    $payload = $request->validate([
      'id' => 'required|exists:item_data,id',
    ]);

    $data = ItemData::findOrFail($payload['id']);

    Helper::addHistory('Xóa sản phẩm ' . $data->name . ' trong nhóm ' . $data->group->name);

    $data->delete();

    return response()->json([
      'status'  => 200,
      'message' => 'Xóa sản phẩm thành công',
    ]);
  }
}