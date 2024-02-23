@extends('admin.layouts.master')
@section('title', 'Admin: User Detail')
@section('content')
  <section>
    <div class="card">
      <div class="card-header">
        <h4>Thông tin chung</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
          @csrf
          <div class="form-group row mb-3">
            <div class="col-lg-6">
              <label for="username" class="form-label">Tài khoản</label>
              <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
            </div>
            <div class="col-lg-6">
              <label for="access_token" class="form-label">Access Token (API)</label>
              <input type="text" class="form-control" id="access_token" value="{{ $user->access_token }}" readonly>
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-lg-6">
              <label for="created_at" class="form-label">Ngày đăng ký</label>
              <input type="text" class="form-control" id="created_at" value="{{ $user->created_at }}" readonly>
            </div>
            <div class="col-lg-6">
              <label for="ip_address" class="form-label">Địa chỉ IP</label>
              <input type="text" class="form-control" id="ip_address" value="{{ $user->ip_address }}" readonly>
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-lg-6">
              <label for="balance" class="form-label">Số tiền hiện tại</label>
              <input type="text" class="form-control" id="balance" value="{{ Helper::formatCurrency($user->balance) }}" readonly>
            </div>
            <div class="col-lg-6">
              <label for="total_deposit" class="form-label">Tổng tiền đã nạp</label>
              <input type="text" class="form-control" id="total_deposit" value="{{ Helper::formatCurrency($user->total_deposit) }}" readonly>
            </div>
          </div>
          <div class="form-group  mb-3">
            <label for="role" class="form-label">Loại tài khoản</label>
            <select class="form-control" id="role" name="role" required>
              <option value="member" @if ($user->role == 'member') selected @endif>Thành viên</option>
              <option value="partner" @if ($user->role == 'partner') selected @endif>Đối tác</option>
              <option value="accounting" @if ($user->role == 'accounting') selected @endif>Kế toán </option>
              {{-- <option value="collaborator" @if ($user->role == 'collaborator') selected @endif>Cộng tác viên</option> --}}
              <option value="admin" @if ($user->role == 'admin') selected @endif>Quản trị viên </option>
            </select>
          </div>
          <div class="form-group row mb-3">
            <div class="col-lg-6">
              <label for="status_id" class="form-label">Trạng thái</label>
              <select class="form-control" id="status_id" name="status" required>
                @php $statuses = ['active','locked']; @endphp
                @foreach ($statuses as $status)
                  <option value="{{ $status }}" @if ($user->status == $status) selected @endif>
                    {{ Str::ucfirst($status) }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-lg-6">
              <label for="email" class="form-label">Địa chỉ e-mail</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Đặt lại mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu nếu cần thay đổi">
          </div>
          <div class="form-group">
            <button class="btn btn-primary w-100" type="submit" name="action" value="update-info">
              Cập nhật
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Cộng tiền thành viên</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label for="amount" class="form-label">Số tiền (*)</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Nhập số tiền cần cộng" required>
              </div>
              <div class="form-group mb-3">
                <label for="reason" class="form-label">Lý do (*)</label>
                <textarea class="form-control" id="reason" name="reason" placeholder="Nhập lý do cộng tiền nếu có"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-success w-100 btn-block" type="submit" name="action" value="plus-money">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Trừ tiền thành viên</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label for="amount" class="form-label">Số tiền (*)</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Nhập số tiền cần trừ" required>
              </div>
              <div class="form-group mb-3">
                <label for="reason" class="form-label">Lý do (*)</label>
                <textarea class="form-control" id="reason" name="reason" placeholder="Nhập lý do trừ tiền nếu có"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-danger w-100 btn-block" type="submit" name="action" value="sub-money">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4>Lịch sử giao dịch [2000 dòng gần nhất]</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive theme-scrollbar">
          <table class="display table table-bordered table-stripped text-nowrap datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Tài khoản</th>
                <th>Giao dịch</th>
                <th>Mã giao dịch</th>
                <th>Số tiền</th>
                <th>Số dư trước</th>
                <th>Số dư sau</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user->transactions()->orderBy('id', 'desc')->limit(2000)->get() as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->username }}</td>
                  <td>{!! Helper::formatTransType($item->type) !!}</td>
                  <td>{{ $item->code }}</td>
                  <td>{{ $item->prefix . ' ' . Helper::formatCurrency($item->amount) }}</td>
                  <td>{{ Helper::formatCurrency($item->balance_before) }}</td>
                  <td>{{ Helper::formatCurrency($item->balance_after) }}</td>
                  <td class="text-wrap">{{ $item->content }} </td>
                  <td>{!! Helper::formatStatus($item->status) !!}</td>
                  <th>{{ $item->created_at }}</th>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4>Nhật ký hoạt động [2000 dòng gần nhất]</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive theme-scrollbar">
          <table class="display table table-bordered table-stripped text-nowrap datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Tài khoản</th>
                <th>Nội dung</th>
                <th>Dữ liệu</th>
                <th>Địa chỉ IP</th>
                <th>Thời gian</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user->histories()->orderBy('id', 'desc')->limit(2000)->get() as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->username }}</td>
                  <td>{{ $item->content }}</td>
                  <td>-</td>
                  <td>{{ $item->ip_address }}</td>
                  <td>{{ $item->created_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </section>
@endsection
