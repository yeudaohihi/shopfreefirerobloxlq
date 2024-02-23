@extends('admin.layouts.master')
@section('title', 'Admin: Accounts Group')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Quản lý nhóm của chuyên mục "{{ $category->name }}"</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive theme-scrollbar">
        <table class="display table table-bordered table-stripped text-nowrap text-center datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Ưu tiên</th>
              <th>Thao tác</th>
              <th>Ảnh / Icon</th>
              <th>Tên nhóm</th>
              <th>Đã bán</th>
              <th>Còn lại</th>
              <th>Doanh thu</th>
              <th>Trạng thái</th>
              <th>Người tạo</th>
              <th>Thời gian</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category->groups as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->priority }}</td>
                <td>
                  <a href="{{ route('admin.accounts.groups.edit', ['id' => $category->id, 'gid' => $item->id]) }}" class="shadow btn btn-primary btn-xs sharp me-1"><i class="fa fa-edit"></i> sửa</a>
                  <a href="{{ route('admin.accounts.items', ['id' => $item->id]) }}" class="shadow btn btn-info btn-xs sharp me-1"><i class="fa fa-eye"></i> Xem</a>
                  <a href="javascript:deleteRow({{ $item->id }})" class="shadow btn btn-danger btn-xs sharp me-1"><i class="fa fa-trash"></i> Xoá</a>
                </td>
                <td><img src="{{ $item->image }}" width="40"></td>
                <td>{{ $item->name }}</td>
                <td><span class="text-primary">{{ $item->sold_count }}</span> nick</td>
                <td><span class="text-danger">{{ $item->in_stock }}</span> nick</td>
                <td>{{ Helper::formatCurrency($item->revenue) }}</td>
                <td>
                  @if ($item->status == 1)
                    <span class="text-success">Hoạt động</span>
                  @else
                    <span class="text-danger">Tạm đóng</span>
                  @endif
                </td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <a href="{{ route('admin.accounts.groups.create', ['id' => $category->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Thêm nhóm mới</a>
      <a href="{{ route('admin.accounts.categories') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Quay lại danh sách chuyên mục</a>
    </div>
  </div>

  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm thông tin mới</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
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
        } = await axios.post('{{ route('admin.accounts.groups.delete') }}', {
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
