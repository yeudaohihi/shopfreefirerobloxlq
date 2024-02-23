@extends('admin.layouts.master')
@section('title', 'Admin: Accounts Item')
@section('css')
  <link rel="stylesheet" type="text/css" href="/_admin/css/vendors/dropzone.css">
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Thêm sản phẩm vào nhóm</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.accounts.items.store', ['id' => $group->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Tên sản phẩm cần bán" required>
        </div>
        <div class="mb-3">
          <label for="code" class="form-label">Mã sản phẩm</label>
          <input type="number" class="form-control" id="code" name="code" value="{{ old('code') }}">
          <i>Mã này chỉ có hiệu lực khi bạn nhập 1 tài khoản, nếu lớn hơn 1 tài khoản hệ thống sẽ random tất cả</i>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Ảnh sản phẩm</label>
          <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="price" class="form-label">Giá bán</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
          </div>
          <div class="col-md-4">
            <label for="cost" class="form-label">Giá nhập</label>
            <input type="text" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" required>
          </div>
          <div class="col-md-4">
            <label for="discount" class="form-label">% Giảm giá</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', 0) }}" required>
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-md-6">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status" required>
              <option value="1">Đang bán</option>
              <option value="0">Ngưng bán</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="type" class="form-label">Loại sản phẩm</label>
            <select name="type" id="type" class="form-control" required>
              <option value="account">Mặc Định</option>
              {{-- <option value="account_group">Gọp Tài Khoản Theo Nhóm</option> --}}
            </select>
            {{-- <small>* Khi chọn gọp tài khoản thì nó không chia ra nhiều sản phẩm khác nhau theo list tài khoản nhập</small> --}}
          </div>
        </div>
        <div class="mb-3">
          <label for="list_item" class="form-label">Danh sách tài khoản</label>
          <textarea class="form-control" id="list_item" name="list_item" rows="3" required>{{ old('list_item') }}</textarea>
          <i>* Nhập nhiều hơn 1 tài khoản thì nó sẽ nhân bản sản phẩm giống nhau, chủ yếu dùng cho mua random</i>
          <br />
          <i>* Mỗi dòng là 1 sản phẩm, có thể nhập USERNAME|PASSWORD|2FA, nội dung này sẽ hiển thị cho người mua</i>
        </div>
        <div class="mb-3">
          <label for="highlights" class="form-label">Chi tiết sản phẩm</label>
          <textarea class="form-control" id="highlights" name="highlights" rows="3" required>{{ old('highlights') }}</textarea>
          <i>Chi tiết nhập như sau: NAME:VALUE => Cấp độ:20, hoặc => Cấp độ 20</i>
        </div>
        @if ($group->game_type === 'lien-minh')
          <div class="mb-3">
            <label for="list_champ" class="form-label">Danh sách tướng</label>
            <textarea class="form-control" id="list_champ" name="list_champ" rows="3" required
              placeholder="1-Annie|2-Olaf|3-Galio|4-Twisted Fate|5-Xin Zhao|6-Urgot|7-LeBlanc|8-Vladimir|9-Fiddlesticks|10-Kayle|11-Master Yi|12-Alistar">{{ old('list_champ') }}</textarea>
          </div>
          <div class="mb-3">
            <label for="list_skin" class="form-label">Danh sách skin</label>
            <textarea class="form-control" id="list_skin" name="list_skin" rows="3" required
              placeholder="championsskin_1012-Annie Sinh Nhật|championsskin_2001-Olaf Kẻ Phản Diện|championsskin_2002-Olaf Băng Giá|championsskin_4007-Twisted Fate Âm Phủ|championsskin">{{ old('list_skin') }}</textarea>
          </div>
        @elseif ($group->game_type === 'dot-kich')
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="cf_vip_ig" class="form-label">VIP InGame</label>
              {{-- 0-8 --}}
              <select name="cf_vip_ig" id="cf_vip_ig" class="form-control" required>
                @for ($i = 0; $i < 10; $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
            <div class="col-md-4">
              <label for="cf_vip_amount" class="form-label">Số Lượng VIP</label>
              <input type="number" class="form-control" id="cf_vip_amount" name="cf_vip_amount" value="{{ old('cf_vip_amount', 0) }}" required>
            </div>
            <div class="col-md-4">
              <label for="cf_the_loai" class="form-label">Thể Loại Nick</label>
              <select name="cf_the_loai" id="cf_the_loai" class="form-control" required>
                <option value="">- Tất Cả -</option>
                <option value="ai">AI</option>
                <option value="c4">C4</option>
                <option value="zombie">Zombie</option>
              </select>
            </div>
          </div>
        @endif
        <div class="mb-3">
          <label for="description" class="form-label">Mô tả sản phẩm</label>
          <textarea class="form-control ckeditor" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
          <label for="list_image" class="form-label">Hình ảnh sản phẩm</label>

          <i>Có thể nhiều hình ảnh cho sản phẩm</i>
          <br />
          <i>Hệ thống sẽ upload ảnh lên hosting</i>
        </div>

        <div class="dropzone dropzone-info" id="fileTypeValidation" action="/api/admin/tools/upload">
          <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
            <h6>Drop files here or click to upload.</h6><span class="note needsclick">(The system will automatically upload after you have finished selecting the photo.)</span>
          </div>
        </div>
        <div class="image-uploaded mb-3"></div>
        <div class="mb-3 text-center">
          <button class="btn btn-primary">Tạo sản phẩm</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h4>Quản lý sản phẩm của nhóm "{{ $group->name }}" - Loại 1</h4>
    </div>
    <div class="card-body">
      <div class="text-center mb-3">
        <button class="btn btn-danger ids-action" onclick="deleteList()"><i class="fa fa-trash"></i> Xoá <span class="checked-count">0</span> sản phẩm</button>
      </div>
      <div class="table-responsive theme-scrollbar">
        <table class="display table-bordered table-stripped text-nowrap datatable1 table text-center">
          <thead>
            <tr>
              <th>
                <input type="checkbox" id="check_all" />
              </th>
              <th>#</th>
              <th>Thao tác</th>
              <th>Tài khoản</th>
              <th>Tên sản phẩm</th>
              <th>Mã sản phẩm</th>
              <th>Giá bán</th>
              <th>Giá nhập</th>
              <th>% Giảm giá</th>
              <th>Ảnh sản phẩm</th>
              <th>Người mua</th>
              <th>Mã đơn hàng</th>
              <th>Trạng thái</th>
              <th>Ngày thêm</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($group->items()->where('type', 'account')->get() as $item)
              <tr>
                <td>
                  <input type="checkbox" class="check_item" value="{{ $item->id }}" />
                </td>
                <td>{{ $item->id }}</td>
                <td>
                  <a href="{{ route('admin.accounts.items.show', ['id' => $item->id]) }}" class="btn btn-primary btn-xs sharp me-1 shadow"><i class="fa fa-pencil"></i> sửa</a>
                  <a href="javascript:deleteRow({{ $item->id }})" class="btn btn-danger btn-xs sharp me-1 shadow"><i class="fa fa-trash"></i> xoá</a>
                </td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->name }}</td>
                <td>#{{ $item->code }}</td>
                <td>{{ Helper::formatCurrency($item->price) }}</td>
                <td>{{ Helper::formatCurrency($item->cost) }}</td>
                <td>{{ $item->discount }}%</td>
                <td><img src="{{ asset($item->image) }}" width="40"></td>
                <td>{{ $item->buyer_name ?? '-' }}</td>
                <td>{{ $item->buyer_code ?? '-' }}</td>
                <td>{!! $item->is_sold === true ? '<span class="text-success">Đã Bán</span>' : '<span class="text-danger">Chưa Bán</span>' !!}</td>
                <td>{{ $item->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">

      <a href="{{ route('admin.accounts.groups', ['id' => $group->category_id]) }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Quay lại danh sách nhóm</a>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="/_admin/js/dropzone/dropzone.js"></script>
  <script src="/plugins/ckeditor/ckeditor.js"></script>

  <script>
    // checkbox table
    $("#check_all").click(function() {
      if ($(this).is(":checked")) {
        $(".check_item").prop("checked", true);
      } else {
        $(".check_item").prop("checked", false);
      }
    });

    $(".check_item").click(function() {
      if ($(".check_item:checked").length == $(".check_item").length) {
        $("#check_all").prop("checked", true);
      } else {
        $("#check_all").prop("checked", false);
      }
    });

    const getIds = () => {
      let ids = [];
      $(".check_item:checked").each(function() {
        ids.push($(this).val());
      });
      return ids;
    }

    // event to class checked-count, checked-ids
    const updateChecked = () => {
      let ids = getIds();
      $(".checked-count").text(ids.length);

      if (ids.length > 0) {
        $(".ids-action").removeClass('disabled btn-disabled')
      } else {
        $(".ids-action").addClass('disabled btn-disabled')
      }
    }

    $(".check_item").click(function() {
      updateChecked();
    });

    $("#check_all").click(function() {
      updateChecked();
    });

    updateChecked();

    //

    $(document).ready(function() {
      $('.datatable1').DataTable({
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
        },
        response: false,
        order: [
          [1, 'desc']
        ],
        lengthMenu: [
          [10, 25, 50, 100, 200, -1],
          [10, 25, 50, 100, 200, "Tất cả"]
        ],
        retrieve: true,
        columnDefs: [{
          targets: 0,
          orderable: false,
          searchable: false,
        }],
      })
    })

    const deleteList = async () => {
      const ids = getIds()

      if (ids.length === 0) {
        Swal.fire('Thất bại', 'Vui lòng chọn ít nhất 1 proxy để xoá', 'error')
        return
      }

      const confirm = await Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn sẽ không thể khôi phục lại dữ liệu này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      })

      if (!confirm.isConfirmed) return

      $showLoading()

      try {
        const {
          data: result
        } = await axios.post('{{ route('admin.accounts.items.delete-list') }}', {
          ids: ids
        })

        Swal.fire('Thành công', result.message, 'success').then(() => {
          window.location.reload();
        })
      } catch (error) {
        Swal.fire('Thất bại', $catchMessage(error), 'error')
      }
    }


    $(function() {
      const editor = CKEDITOR.replace('.ckeditor', {
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
        } = await axios.post('{{ route('admin.accounts.items.delete') }}', {
          id
        })

        Swal.fire('Thành công', result.message, 'success').then(() => {
          window.location.reload();
        })
      } catch (error) {
        Swal.fire('Thất bại', $catchMessage(error), 'error')
      }
    }

    var DropzoneExample = function() {
      var DropzoneDemos = function() {
        Dropzone.options.fileTypeValidation = {
          paramName: "file",
          maxFiles: 100,
          maxFilesize: 20,
          acceptedFiles: "image/*",
          headers: {
            'Authorization': 'Bearer {{ auth()->user()->access_token }}',
          },
          dictRemoveFile: 'Xóa',
          addRemoveLinks: true,
          complete(file) {
            if (file.xhr) {
              let obj = JSON.parse(file.xhr.response);
              if (file.xhr.status == 200) {
                let info = obj.data;
                let elm = document.querySelector('.image-uploaded');

                elm.innerHTML += `<input type="hidden" name="list_image[]" value="${info.path}" data-file-id="${file.upload.uuid}" />`;
              } else {
                Swal.fire('Thất bại', obj.message, 'error');
              }
            }
          },
          removedfile: function(file) {
            document.querySelector(`.image-uploaded [data-file-id="${file.upload.uuid}"]`).remove();
            let _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
          },
          // if error
          error(file, message) {
            console.log(message);
            if (file.previewElement) {
              file.previewElement.classList.add("dz-error");
              return file.previewElement.querySelector("[data-dz-error-message]").textContent = message?.message || 'Unknown error';
            }
          }
        };
      }
      return {
        init: function() {
          DropzoneDemos();
        }
      };
    }();
    DropzoneExample.init();
  </script>
@endsection
