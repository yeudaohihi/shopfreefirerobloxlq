@extends('admin.layouts.master')
@section('title', 'Admin: Users Management')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Quản lý thành viên</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive theme-scrollbar">
        <table class="display table table-bordered table-stripped text-nowrap text-center" id="basic-1">
          <thead>
            <tr>
              <th>#</th>
              <th>Thao tác</th>
              <th>Tài khoản</th>
              <th>Email</th>
              <th>Số dư</th>
              <th>Tổng nạp</th>
              <th>Cấp độ</th>
              <th>Trạng thái</th>
              <th>Địa chỉ IP</th>
              <th>Đăng Ký Bằng</th>
              <th>Ngày đăng ký</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
      //DataTable
      $("#basic-1").DataTable({
        order: [0, 'desc'],
        responsive: false,
        lengthMenu: [
          [10, 50, 100, 200, 500, 1000, 2000, 10000, -1],
          [10, 50, 100, 200, 500, 1000, 2000, 10000, "All"]
        ],
        language: {
          searchPlaceholder: 'Tìm kiếm...',
          sSearch: '',
          lengthMenu: '_MENU_',
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: '/api/admin/users',
          async: true,
          type: 'GET',
          dataType: 'json',
          headers: {
            'Authorization': 'Bearer ' + userData.access_token,
            'Accept': 'application/json',
          },
          data: function(data) {
            let payload = {}
            // default params

            // set params
            payload.page = data.start / data.length + 1;
            payload.limit = data.length;
            payload.search = data.search.value;
            payload.sort_by = data.columns[data.order[0].column].data;
            payload.sort_type = data.order[0].dir;
            // return json
            return payload;
          },
          error: function(xhr) {
            Swal.fire('Thất bại', $catchMessage(xhr), 'error')
          },
          dataFilter: function(data) {
            let json = JSON.parse(data);
            if (json.status) {
              json.recordsTotal = json.data.meta.total
              json.recordsFiltered = json.data.meta.total
              json.data = json.data.data
              return JSON.stringify(json); // return JSON string
            } else {
              Swal.fire('Thất bại', json.message, 'error')
              return JSON.stringify({
                recordsTotal: 0,
                recordsFiltered: 0,
                data: []
              }); // return JSON string
            }
          }
        },
        columns: [{
          data: 'id',
        }, {
          render: function(data, type, row) {
            return `<a href="/admin/users/edit/${row.id}" class="shadow btn btn-primary btn-xs sharp me-1"><i class="fa fa-edit"></i> xem</a>`
          }
        }, {
          data: 'username',
        }, {
          data: 'email',
        }, {
          data: 'balance',
          render: function(data) {
            return $formatCurrency(data)
          }
        }, {
          data: 'total_deposit',
          render: function(data) {
            return $formatCurrency(data)
          }
        }, {
          data: 'role',
          render: function(data) {
            return data === 'admin' ? '<span class="badge bg-danger">Admin</span>' : '<span class="badge bg-primary">Member</span>'
          }
        }, {
          data: 'status',
          render: function(data) {
            return data === 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Locked</span>'
          }
        }, {
          data: 'ip_address',
        }, {
          data: 'register_by'
        }, {
          data: 'created_at',
          render: function(data) {
            return $formatDate(data)
          }
        }],
        columnDefs: [{
          orderable: false,
          targets: [1]
        }],
      })
    })
  </script>
@endsection
