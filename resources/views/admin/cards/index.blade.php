@extends('admin.layouts.master')
@section('title', 'Admin: Card List')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Danh sách thẻ cào</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive theme-scrollbar">
        <table class="display table table-bordered table-stripped text-nowrap text-center datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>API ID</th>
              <th>Tài khoản</th>
              <th>Loại thẻ</th>
              <th>Mã thẻ</th>
              <th>Serial thẻ</th>
              <th>Mệnh giá</th>
              <th>Thực nhận</th>
              <th>Nội dung</th>
              <th>Kênh gạch</th>
              <th>Trạng thái</th>
              <th>Thời gian</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cards as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->serial }}</td>
                <td>{{ Helper::formatCurrency($item->value) }}</td>
                <td>{{ Helper::formatCurrency($item->amount) }}</td>
                <td>{{ $item->content }}</td>
                <td>{{ $item->channel_charge }}</td>
                <td>{!! Helper::formatStatus($item->status) !!}</td>
                <td>{{ $item->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
