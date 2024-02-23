@extends('admin.layouts.master')
@section('title', 'Admin: Item Data #' . $item->id)
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Chỉnh sửa sản phẩm "{{ $item->name }} - {{ $item->code }}"</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.items.data.update', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}" placeholder="Tên sản phẩm cần bán" required>
        </div>
        <div class="mb-3">
          <label for="code" class="form-label">Mã sản phẩm</label>
          <input type="number" class="form-control" id="code" name="code" value="{{ old('code', $item->code) }}" required>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Ảnh sản phẩm - <a href="{{ asset($item->image) }}" target="_blank">xem ảnh</a></label>
          <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Thông tin cần</label>
          <select name="type" id="type" class="form-control" required>
            <option value="">- Chọn Thông Tin -</option>
            <option value="addfriend" @if ($item->type === 'addfriend') selected @endif>Kết Bạn Với Shop</option>
            <option value="user_pass" @if ($item->type === 'user_pass') selected @endif>Tài Khoản + Mật Khẩu</option>
          </select>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="price" class="form-label">Giá sản phẩm</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $item->price) }}" required>
          </div>
          <div class="col-md-6">
            <label for="discount" class="form-label">% Giảm giá</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', $item->discount) }}" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Trạng thái</label>
          <select class="form-control" id="status" name="status" required>
            <option value="1" @if ($item->status === true) selected @endif>Đang bán</option>
            <option value="0" @if ($item->status === false) selected @endif>Chưa bán</option>
          </select>
        </div>
        @php
          $highlights = '';
          if (is_array($item->highlights)) {
              foreach ($item->highlights as $value) {
                  if (!isset($value['name']) && !isset($value['value'])) {
                      $highlights .= ($value[0] ?? ($value ?? '')) . "\n";
                  } else {
                      $highlights .= ($value['name'] ?? '') . ':' . ($value['value'] ?? '') . "\n";
                  }
              }
          }
        @endphp
        <div class="mb-3">
          <label for="highlights" class="form-label">Chi tiết sản phẩm</label>
          <textarea class="form-control" id="highlights" name="highlights" rows="3" required>{{ old('highlights', $highlights) }}</textarea>
          <i>Có thể nhập danh sách nick game cần kết bạn trước khi giao dịch...</i>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Mô tả sản phẩm</label>
          <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $item->description) }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary">Cập Nhật Ngay</button>
          <br />
          <br />
          <a href="{{ route('admin.items.data', ['id' => $item->group_id]) }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Quay lại ngay</a>
        </div>
      </form>
    </div>
  </div>
@endsection
