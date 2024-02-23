@extends('admin.layouts.master')
@section('title', 'Admin: General Settings')
@section('css')
  <link rel="stylesheet" href="{{ asset('/plugins/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/codemirror/theme/monokai.css') }}">
@endsection
@section('content')
  <div class="card">
    <div class="card-header pb-0">
      <h4>Cài đặt chung</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.settings.general.update', ['type' => 'general']) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="title" class="form-label">Tiêu đề</label>
          <input type="text" class="form-control" id="title" name="title" value="{{ old('title', setting('title')) }}">
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="keywords" class="form-label">Từ khoá</label>
            <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords', setting('keywords')) }}">
          </div>
          <div class="col-md-4">
            <label for="description" class="form-label">Mô tả</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', setting('description')) }}">
          </div>
          <div class="col-md-4">
            <label for="primary_color" class="form-label">Màu chính - <span style="color: {{ setting('primary_color') }}">MÀU HIỆN TẠI</span></label>
            <input type="color" class="form-control mb-1" id="primary_color" name="primary_color" value="{{ old('primary_color', setting('primary_color')) }}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <label for="logo_light" class="form-label">Logo Light</label>
            <input type="file" class="form-control" id="logo_light" name="logo_light">
            <div class="mb-2 mt-2 text-center">
              <img src="{{ asset(setting('logo_light')) }}" alt="Logo" class="img-fluid" style="max-height: 100px;">
            </div>
          </div>
          <div class="col-md-3">
            <label for="logo_dark" class="form-label">Logo Dark</label>
            <input type="file" class="form-control" id="logo_dark" name="logo_dark">
            <div class="mb-2 mt-2 text-center">
              <img src="{{ asset(setting('logo_dark')) }}" alt="Logo" class="img-fluid" style="max-height: 100px;">
            </div>
          </div>
          <div class="col-md-3">
            <label for="favicon" class="form-label">Favicon</label>
            <input type="file" class="form-control" id="favicon" name="favicon">
            <div class="mb-2 mt-2 text-center">
              <img src="{{ asset(setting('favicon')) }}" alt="Favicon" class="img-fluid" style="max-height: 100px;">
            </div>
          </div>
          <div class="col-md-3">
            <label for="logo_share" class="form-label">Logo Share</label>
            <input type="file" class="form-control" id="logo_share" name="logo_share">
            <div class="mb-2 mt-2 text-center">
              <img src="{{ asset(setting('logo_share')) }}" alt="logo_share" class="img-fluid" style="max-height: 100px;">
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="email" class="form-label">Email Admin</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', setting('email')) }}">
          </div>
          <div class="col-md-4">
            <label for="time_wait_free" class="form-label">Giới hạn thời gian mua mỗi lượt</label>
            <input type="number" class="form-control" id="time_wait_free" name="time_wait_free" value="{{ old('time_wait_free', setting('time_wait_free', 10)) }}">
            <small>Ví dụ nhập vào số 10: tức sau khi mua hàng, user đó phải đợi 10 giây mới có thể thực hiện tiếp giao dịch mua</small>
          </div>
          <div class="col-md-4">
            <label for="max_ip_reg" class="form-label">Giới hạn số tài khoản đăng ký trên 1 IP</label>
            <input type="number" class="form-control" id="max_ip_reg" name="max_ip_reg" value="{{ old('max_ip_reg', setting('max_ip_reg', 5)) }}">
            <small>VD: 5 => mỗi IP chỉ được tạo tối đa 5 tài khoản</small>
          </div>
        </div>
        <div class="mb-3 text-end">
          <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Thông Tin Rút Tiền MiniGame</h4>
        </div>
        <div class="card-body">
          @php $mng_withdraw = Helper::getConfig('mng_withdraw'); @endphp
          <form action="{{ route('admin.settings.general.update', ['type' => 'mng_withdraw']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="unit" class="form-label">Đơn Vị</label>
                <input type="text" class="form-control" id="unit" name="unit" value="{{ $mng_withdraw['unit'] ?? 'Robux' }}" required>
              </div>
              <div class="col-md-6">
                <label for="youtube_id" class="form-label">ID Youtube</label>
                <input type="text" class="form-control" id="youtube_id" name="youtube_id" value="{{ $mng_withdraw['youtube_id'] ?? '' }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="min_withdraw" class="form-label">Tối Thiểu</label>
                <input type="number" class="form-control" id="min_withdraw" name="min_withdraw" value="{{ $mng_withdraw['min_withdraw'] ?? 0 }}" required>
              </div>
              <div class="col-md-6">
                <label for="max_withdraw" class="form-label">Tối Đa / Lần</label>
                <input type="number" class="form-control" id="max_withdraw" name="max_withdraw" value="{{ $mng_withdraw['max_withdraw'] ?? 0 }}" required>
              </div>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Thông Tin Nạp Tiền</h4>
        </div>
        <div class="card-body">
          @php $deposit_port = Helper::getConfig('deposit_port'); @endphp
          <form action="{{ route('admin.settings.general.update', ['type' => 'deposit_port']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="card" class="form-label">Thẻ Cào</label>
                <select name="value[card]" id="card" class="form-control">
                  <option value="1" {{ ($deposit_port['card'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($deposit_port['card'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="bank" class="form-label">Ngân Hàng</label>
                <select name="value[bank]" id="bank" class="form-control">
                  <option value="1" {{ ($deposit_port['bank'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($deposit_port['bank'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="crypto" class="form-label">Tiền Mã Hoá</label>
                <select name="value[crypto]" id="crypto" class="form-control">
                  <option value="1" {{ ($deposit_port['crypto'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($deposit_port['crypto'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="paypal" class="form-label">Paypal</label>
                <select name="value[paypal]" id="paypal" class="form-control">
                  <option value="1" {{ ($deposit_port['paypal'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($deposit_port['paypal'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="perfect_money" class="form-label">Perfect Money</label>
                <select name="value[perfect_money]" id="perfect_money" class="form-control">
                  <option value="1" {{ ($deposit_port['perfect_money'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($deposit_port['perfect_money'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Thông Tin Giới Thiệu</h4>
        </div>
        <div class="card-body">
          @php $shop_info = Helper::getConfig('shop_info'); @endphp
          <form action="{{ route('admin.settings.general.update', ['type' => 'shop_info']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="footer_text_1" class="form-label">Footer Text 1</label>
              <input type="text" class="form-control" id="footer_text_1" name="footer_text_1" value="{{ $shop_info['footer_text_1'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="footer_text_2" class="form-label">Footer Text 2</label>
              <input type="text" class="form-control" id="footer_text_2" name="footer_text_2" value="{{ $shop_info['footer_text_2'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="dashboard_text_1" class="form-label">Dashboard Text 1</label>
              <input type="text" class="form-control" id="dashboard_text_1" name="dashboard_text_1" value="{{ $shop_info['dashboard_text_1'] ?? '' }}">
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Thông Tin Nạp Tiền</h4>
        </div>
        <div class="card-body">
          @php $deposit_info = Helper::getConfig('deposit_info'); @endphp
          <form action="{{ route('admin.settings.general.update', ['type' => 'deposit_info']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="prefix" class="form-label">Cú Pháp</label>
              <input type="text" class="form-control" id="prefix" name="prefix" value="{{ $deposit_info['prefix'] ?? 'hello ' }}" required>
            </div>
            <div class="mb-3">
              <label for="discount" class="form-label">Khuyến Mãi [+ %]</label>
              <input type="text" class="form-control" id="discount" name="discount" value="{{ $deposit_info['discount'] ?? 0 }}" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Dashboard Text 1</label>
              <input type="text" class="form-control" id="description" name="description" value="{{ $deposit_info['description'] ?? '' }}" disabled>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Tuỳ chỉnh giao diện</h4>
        </div>
        <div class="card-body">
          @php $bconfig = Helper::getConfig('theme_custom'); @endphp
          <form action="{{ route('admin.settings.general.update', ['type' => 'theme_custom']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
              <div class="col-md-6">
                <label for="card_stats" class="form-label">Thẻ Thống Kê</label>
                <select class="form-select" id="card_stats" name="card_stats">
                  <option value="1" {{ ($bconfig['card_stats'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($bconfig['card_stats'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="product_info_type" class="form-label">Thẻ Thống Kê</label>
                <select class="form-select" id="product_info_type" name="product_info_type">
                  <option value="0" {{ ($bconfig['product_info_type'] ?? null) == 0 ? 'selected' : '' }}>Chỉ hiện nick còn lại</option>
                  <option value="1" {{ ($bconfig['product_info_type'] ?? null) == 1 ? 'selected' : '' }}>Hiện đã bán và Nick còn lại</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-md-6">
                <label for="buy_button_img" class="form-label">Link ảnh nút mua</label>
                <input type="text" class="form-control" id="buy_button_img" name="buy_button_img" value="{{ $bconfig['buy_button_img'] ?? '_assets/images/stores/view-all.gif' }}">
              </div>
              <div class="col-md-6">
                <label for="enable_custom_theme" class="form-label">Cho Phép Tuỳ Chỉnh Theme</label>
                <select class="form-select" id="enable_custom_theme" name="enable_custom_theme">
                  <option value="1" {{ ($bconfig['enable_custom_theme'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($bconfig['enable_custom_theme'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-md-6">
                <label for="show_thongbao" class="form-label">Hiện Thông Báo Chạy</label>
                <select class="form-select" id="show_thongbao" name="show_thongbao">
                  <option value="1" {{ ($bconfig['show_thongbao'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($bconfig['show_thongbao'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="show_lsmua" class="form-label">Hiện Lịch Sử Mua Nick</label>
                <select class="form-select" id="show_lsmua" name="show_lsmua">
                  <option value="1" {{ ($bconfig['show_lsmua'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($bconfig['show_lsmua'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="show_banner" class="form-label">Hiện Banner và TOP Nạp</label>
                <select class="form-select" id="show_banner" name="show_banner">
                  <option value="1" {{ ($bconfig['show_banner'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($bconfig['show_banner'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="show_all_account_img" class="form-label">Tắt Slide ảnh sản phẩm (Account Info)</label>
                <select class="form-select" id="show_all_account_img" name="show_all_account_img">
                  <option value="1" {{ ($bconfig['show_all_account_img'] ?? null) == 1 ? 'selected' : '' }}>Bật</option>
                  <option value="0" {{ ($bconfig['show_all_account_img'] ?? null) == 0 ? 'selected' : '' }}>Tắt</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="youtube" class="form-label">Youtube ID</label>
                <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $bconfig['youtube'] ?? '' }}">
              </div>
              <div class="col-md-6">
                <label for="banner" class="form-label">Banner - <a href="{{ asset($bconfig['banner'] ?? '') }}" target="_blank">xem ảnh</a></label>
                <input type="file" class="form-control" id="banner" name="banner">
              </div>
              <i>* Nếu nhập Youtube ID thì ảnh sẽ không hoạt động</i>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="background_image" class="form-label">Link Ảnh Nền - <a href="{{ asset($bconfig['background_image'] ?? '') }}" target="_blank">xem ảnh</a></label>
                <input type="url" class="form-control" id="background_image" name="background_image" value="{{ $bconfig['background_image'] ?? '' }}">
              </div>
              <div class="col-md-6">
                <label for="minigame_pos" class="form-label">Vị Trí Hiện MiniGame</label>
                <select class="form-select" id="minigame_pos" name="minigame_pos">
                  <option value="0" {{ ($bconfig['minigame_pos'] ?? null) == 0 ? 'selected' : '' }}>Không Hiện</option>
                  <option value="top" {{ ($bconfig['minigame_pos'] ?? null) == 'top' ? 'selected' : '' }}>Bên Trên</option>
                  <option value="bottom" {{ ($bconfig['minigame_pos'] ?? null) == 'bottom' ? 'selected' : '' }}>Bên Dưới</option>
                </select>
              </div>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Thông tin liên hệ</h4>
        </div>
        <div class="card-body">
          @php $contact = Helper::getConfig('contact_info'); @endphp
          <form action="{{ route('admin.settings.general.update', ['type' => 'contact_info']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $contact['facebook'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="telegram" class="form-label">Telegram</label>
                <input type="text" class="form-control" id="telegram" name="telegram" value="{{ $contact['telegram'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="twitter" class="form-label">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $contact['twitter'] ?? '' }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="phone_no" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ $contact['phone_no'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $contact['email'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="discord" class="form-label">Discord</label>
                <input type="text" class="form-control" id="discord" name="discord" value="{{ $contact['discord'] ?? '' }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $contact['instagram'] ?? '' }}">
              </div>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Header Code</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.general.update', ['type' => 'header_script']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="code" class="form-label">Code</label>
              <textarea class="form-control" name="code" id="editor1" rows="10">{{ Helper::getNotice('header_script') }}</textarea>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <h4>Footer Code</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.general.update', ['type' => 'footer_script']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="code" class="form-label">Code</label>
              <textarea class="form-control" name="code" id="editor2" rows="10">{{ Helper::getNotice('footer_script') }}</textarea>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="{{ asset('/plugins/codemirror/codemirror.js') }}"></script>
  <script src="{{ asset('/plugins/codemirror/mode/css/css.js') }}"></script>
  <script src="{{ asset('/plugins/codemirror/mode/xml/xml.js') }}"></script>
  <script src="{{ asset('/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

  <script>
    $(function() {
      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("editor1"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
      CodeMirror.fromTextArea(document.getElementById("editor2"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>
@endsection
