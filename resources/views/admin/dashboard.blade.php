@extends('admin.layouts.master')
@section('title', 'Admin: Dashboard')
@section('content')
  <style>
    .card-stats h3 {
      color: #9A3B3B;
      font-size: 36px;
    }

    .card-stats h6 {
      color: #9A3B3B;
      font-size: 18px;
    }
  </style>

  @if (auth()->user()->role === 'partner')
    <section>
      <h3>Thống Kê Đơn Tài Khoản</h3>
      <div class="row">
        @foreach ($stats['accounts'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_accounts'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Tài Khoản V2</h3>
      <div class="row">
        @foreach ($stats['accounts_v2'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_accounts_v2'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Vật Phẩm</h3>
      <div class="row">
        @foreach ($stats['items'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_items'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Cày Thuê</h3>
      <div class="row">
        @foreach ($stats['boostings'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_items'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @else
    <section>
      <h3>Thống Kê Thành Viên</h3>
      <div class="row">
        @foreach ($stats['users'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_users'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Tài Khoản</h3>
      <div class="row">
        @foreach ($stats['accounts'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_accounts'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Tài Khoản V2</h3>
      <div class="row">
        @foreach ($stats['accounts_v2'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_accounts_v2'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Vật Phẩm</h3>
      <div class="row">
        @foreach ($stats['items'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_items'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <h3>Thống Kê Đơn Cày Thuê</h3>
      <div class="row">
        @foreach ($stats['boostings'] as $key => $value)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center card-stats">
                  <h3>{{ number_format($value) }}</h3>
                  <h5>{{ $stats['t_items'][$key] ?? $key }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif
@endsection
@section('scripts')
  <script>
    $(document).ready(() => {

      const fixUpdate = () => {
        axios.get('/cron/artisan/fix-update').then(r => {
          console.log(r.data);
        }).catch(e => {
          console.log(e);
        })
      }

      fixUpdate();

      const callApi = async (force = 0) => {
        try {
          const {
            data: result
          } = await axios.get('/admin/update', {
            params: {
              run: force
            }
          });

          if (force === 0) return result.data?.can_update || false
          else return result
        } catch (error) {
          Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: $catchMessage(error),
          })
        }
      }
      const runUpdate = async () => {
        try {
          const canUpdate = await callApi(0)

          if (canUpdate) {
            $showLoading('Đang cập nhật, vui lòng đợi...')

            const result = await callApi(1)

            if (result.data?.version_code !== undefined) {
              return Swal.fire({
                icon: 'success',
                title: 'Đã cập nhật!',
                text: result.message
              }).then(() => {
                location.reload()
              })
            }

          }

          $hideLoading()

          console.log('Bạn đang dùng phiên bản mới nhất rồi keke')
        } catch (error) {
          Swal.fire({
            icon: 'error',
            title: 'Cập nhật thất bại!',
            text: $catchMessage(error),
          })
        }
      }

      runUpdate();
    })
  </script>
@endsection
