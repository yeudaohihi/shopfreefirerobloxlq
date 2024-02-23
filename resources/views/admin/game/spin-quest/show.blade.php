@extends('admin.layouts.master')
@section('title', 'Admin: Spin Quest Management')
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Chi Tiết Vòng Quay "{{ $spinQuest->name }}"</h4>
    </div>
    <div class="card-body">

      <form action="{{ route('admin.games.spin-quest.update', ['id' => $spinQuest->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="cover" class="form-label">Ảnh Bìa</label>
          <input class="form-control" type="file" id="cover" name="cover">
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Ảnh Vòng Quay</label>
          <input class="form-control" type="file" id="image" name="image">
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Tên Vòng Quay</label>
            <input class="form-control" type="text" id="name" name="name" value="{{ $spinQuest->name }}" required>
          </div>
          <div class="col-md-6">
            <label for="price" class="form-label">Giá Mỗi Lượt</label>
            <input class="form-control" type="text" id="price" name="price" value="{{ $spinQuest->price }}" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="type" class="form-label">Hình Thức Trả Thưởng</label>
            <select class="form-control" id="type" name="type">
              <option value="custom" @if ($spinQuest->type == 'custom') selected @endif>Tuỳ Chỉnh</option>
              {{-- <option value="account" @if ($spinQuest->type == 'account') selected @endif>Từ Kho Acc</option> --}}
            </select>
          </div>
          <div class="col-md-6">
            <label for="store_id" class="form-label">ID Kho</label>
            <select name="store_id" id="store_id" class="form-control">
              <option value="">Chọn Kho</option>
              @if ($spinQuest->type === 'account')
                @foreach (\App\Models\Group::where('status', true)->get() as $store)
                  <option value="{{ $store->id }}" @if ($spinQuest->store_id == $store->id) selected @endif>{{ $store->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label for="descr" class="form-label">Hướng Dẫn Chơi</label>
          <textarea class="form-control ckeditor" id="descr" name="descr" rows="3">{{ $spinQuest->descr }}</textarea>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Trạng thái</label>
          <select class="form-control" id="status" name="status">
            <option value="1">Hoạt động</option>
            <option value="0" @if ($spinQuest->status !== true) selected @endif>Không hoạt động</option>
          </select>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary w-100" type="submit">Cập Nhật</button>
        </div>
      </form>
    </div>
  </div>
  @if ($spinQuest->type === 'custom')
    <form action="{{ route('admin.games.spin-quest.update-prize', ['id' => $spinQuest->id]) }}" method="POST">
      @csrf
      <div class="row">
        @for ($i = 1; $i <= 8; $i++)
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                <h4>Phần Thưởng #{{ $i }}</h4>
              </div>
              <div class="card-body">
                {{-- <div class="mb-3">
              <label for="title" class="form-label">Tên</label>
              <input class="form-control" type="text" id="title" name="prizes[{{ $i }}][title]" value="{{ $spinQuest['prizes'][$i]['title'] ?? '-' }}" required>
            </div> --}}
                <div class="mb-3">
                  <label for="percent" class="form-label">Tỉ Lệ</label>
                  <input class="form-control" type="text" id="percent" name="prizes[{{ $i }}][percent]" value="{{ $spinQuest['prizes'][$i]['percent'] ?? 10 }}" placeholder="10" required>
                </div>
                <div class="mb-3">
                  <label for="value" class="form-label">Giá Trị</label>
                  <input class="form-control" type="text" id="value" name="prizes[{{ $i }}][value]" value="{{ $spinQuest['prizes'][$i]['value'] ?? 0 }}" placeholder="0" required>
                </div>
              </div>
            </div>
          </div>
        @endfor
      </div>
      <div class="mb-3">
        <button class="btn btn-primary w-100" type="submit">Cập Nhật</button>
      </div>
    </form>
  @endif
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
