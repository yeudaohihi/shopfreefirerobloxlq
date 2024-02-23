@extends('admin.layouts.master')
@section('title', 'Admin: Post Create')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Thêm bài viết mới</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
          <div class="col-md-6">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
          </div>
          <div class="col-md-6">
            <label for="keywords" class="form-label">Từ khoá</label>
            <input type="text" class="form-control" id="keywords" name="meta_data[keywords]" value="{{ old('keywords') }}" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="thumbnail" class="form-label">Ảnh bìa</label>
          <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Mô tả ngắn</label>
          <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="priority" class="fomr-label">Ưu tiên</label>
            <input type="number" class="form-control" id="priority" name="priority" value="{{ old('priority', 0) }}" required>
            <small>Số lớn thì hiện trước</small>
          </div>
          <div class="col-md-6">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" id="status" name="status" required>
              <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
              <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Nội dung</label>
          <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
        </div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary">Thêm bài viết</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="/plugins/ckeditor/ckeditor.js"></script>

  <script>
    $(function() {
      const editor = CKEDITOR.replace('content', {
        extraPlugins: 'notification',
        clipboard_handleImages: false,
        filebrowserImageUploadUrl: '/api/admin/tools/upload?form=ckeditor'
      });

      editor.on('fileUploadRequest', function(evt) {
        var xhr = evt.data.fileLoader.xhr;

        xhr.setRequestHeader('Cache-Control', 'no-cache');
        xhr.setRequestHeader('Authorization', 'Bearer ' + userData.access_token);
      })

    })
  </script>
@endsection
