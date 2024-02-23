@extends('admin.layouts.master')
@section('title', 'Admin: Dashboard')
@section('content')
  <div class="text-center">
    <h4>Thông tin giấy phép của bạn không hợp lệ, vui lòng kiểm tra lại!</h4>
    <code>Mã kích hoạt: {{ Helper::hideUsername(env('CLIENT_SECRET_KEY', ''), 20) }}</code>
    <br />
    <code>Chi tiết lỗi: {{ $check['msg'] }}</code>
    <br />
    <p>Hướng dẫn khắc phục: truy cập vào vps/hosting kiểm tra và cập nhật
      "CLIENT_SECRET_KEY=" tại file .env trong thư mục cài đặt website, nếu chưa có giấy phép vui lòng liên hệ mua bản quyền tại <a href="https://www.cmsnt.co/2023/09/thiet-ke-website-ban-nick-game-mau-3.html"
      target="_blank">đây</a></p>
  </div>
@endsection
