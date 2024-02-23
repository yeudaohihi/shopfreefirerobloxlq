@extends('admin.layouts.master')
@section('title', 'Admin: Items Data')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Thêm sản phẩm vào nhóm</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.items.data.store', ['id' => $group->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Tên sản phẩm cần bán" required>
        </div>
        <div class="mb-3">
          <label for="code" class="form-label">Mã sản phẩm</label>
          <input type="number" class="form-control" id="code" name="code" value="{{ old('code') }}">
          <i>Mã này chỉ có hiệu lực khi bạn nhập 1 sản phẩm, nếu lớn hơn 1 sản phẩm hệ thống sẽ random tất cả</i>
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Thông tin cần</label>
          <select name="type" id="type" class="form-control" required>
            <option value="">- Chọn Thông Tin -</option>
            <option value="addfriend">Kết Bạn Với Shop</option>
            <option value="user_pass">Tài Khoản + Mật Khẩu</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Ảnh sản phẩm</label>
          <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="price" class="form-label">Giá sản phẩm</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
          </div>
          <div class="col-md-6">
            <label for="discount" class="form-label">% Giảm giá</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', 0) }}" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Trạng thái</label>
          <select class="form-control" id="status" name="status" required>
            <option value="1">Đang bán</option>
            <option value="0">Chưa bán</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="highlights" class="form-label">Chi tiết sản phẩm</label>
          <textarea class="form-control" id="highlights" name="highlights" rows="3" required>{{ old('highlights') }}</textarea>
          <i>Có thể nhập danh sách nick game cần kết bạn trước khi giao dịch...</i>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Mô tả sản phẩm</label>
          <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary">Tạo sản phẩm</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h4>Quản lý sản phẩm của nhóm "{{ $group->name }}"</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive theme-scrollbar">
        <table class="display table-bordered table-stripped text-nowrap datatable table text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Thao tác</th>
              <th>Mã sản phẩm</th>
              <th>Tên Sản Phẩm</th>
              <th>Giá bán</th>
              <th>% Giảm giá</th>
              <th>Ảnh sản phẩm</th>
              <th>Trạng thái</th>
              <th>Ngày thêm</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($group->data as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>
                  <a href="{{ route('admin.items.data.show', ['id' => $item->id]) }}" class="btn btn-primary btn-xs sharp me-1 shadow"><i class="fa fa-pencil"></i> sửa</a>
                  <a href="javascript:deleteRow({{ $item->id }})" class="btn btn-danger btn-xs sharp me-1 shadow"><i class="fa fa-trash"></i> xoá</a>
                </td>
                <td>#{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ Helper::formatCurrency($item->price) }}</td>
                <td>{{ $item->discount }}%</td>
                <td>
                  <a href="{{ asset($item->image) }}" target="_blank"><img src="{{ asset($item->image) }}" width="40" height="20"></a>
                </td>
                <td>{!! $item->status === true ? '<span class="text-success">Đang Bán</span>' : '<span class="text-danger">Ngưng Bán</span>' !!}</td>
                <td>{{ $item->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <a href="{{ route('admin.items.groups', ['id' => $group->category_id]) }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Quay lại danh sách nhóm</a>
    </div>
  </div>

@endsection
@section('scripts')
  <script>
    const deleteRow = async (id) => {
      const confirmDelete = await Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn sẽ không thể khôi phục lại dữ liệu này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      });

      if (!confirmDelete.isConfirmed) return;

      $showLoading();

      try {
        const {
          data: result
        } = await axios.post('{{ route('admin.items.data.delete') }}', {
          id
        })

        Swal.fire('Thành công', result.message, 'success').then(() => {
          window.location.reload();
        })
      } catch (error) {
        Swal.fire('Thất bại', $catchMessage(error), 'error')
      }
    }
  </script>
@endsection
