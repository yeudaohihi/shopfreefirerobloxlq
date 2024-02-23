@extends('admin.layouts.master')
@section('title', 'Admin: Notices Settings')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Trang chủ</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'home_dashboard']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $home_dashboard ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Nổi ở trang chủ</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'modal_dashboard']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $modal_dashboard ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Trang nạp tiền qua thẻ / ngân hàng</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'page_deposit']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $page_deposit ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Trang nạp tiền bằng crypto</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'page_deposit_crypto']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $page_deposit_crypto ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Trang nạp tiền qua perfect money</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'page_deposit_pmoney']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $page_deposit_pmoney ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Trang nạp tiền qua paypal</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'page_deposit_paypal']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $page_deposit_paypal ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Thông báo | Trang thông tin tài khoản v1/v2</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.notices.update', ['type' => 'page_account_info']) }}" method="POST">
        @csrf
        <div class="mb-3">
          <textarea class="form-control" name="content" rows="5">{{ $page_account_info ?? '' }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="/plugins/ckeditor/ckeditor.js"></script>

  <script>
    $(function() {
      const editors = document.querySelectorAll('[name=content]');

      for (const editor of editors) {
        const ed = CKEDITOR.replace(editor, {
          extraPlugins: 'notification',
          clipboard_handleImages: false,
          filebrowserImageUploadUrl: '/api/admin/tools/upload?form=ckeditor'
        });

        ed.on('fileUploadRequest', function(evt) {
          var xhr = evt.data.fileLoader.xhr;

          xhr.setRequestHeader('Cache-Control', 'no-cache');
          xhr.setRequestHeader('Authorization', 'Bearer ' + userData.access_token);
        })
      }

    })
  </script>
@endsection
