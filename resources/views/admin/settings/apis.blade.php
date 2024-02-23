@extends('admin.layouts.master')
@section('title', 'Admin: Apis Settings')
@section('content')
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>AutoBank | Web2m | Vietcombank</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'web2m_vietcombank']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="account_number" class="form-label">Số Tài Khoản</label>
                <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $web2m_vietcombank['account_number'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="account_password" class="form-label">Mật khẩu Bank</label>
                <input type="password" class="form-control" id="account_password" name="account_password" value="{{ $web2m_vietcombank['account_password'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="api_token" class="form-label">API Token Web2m</label>
                <input type="text" class="form-control" id="api_token" name="api_token" value="{{ $web2m_vietcombank['api_token'] ?? '' }}">
              </div>
            </div>
            <div class="mb-3">
              <label for="link_cron" class="form-label">Link Cron (manual)</label>
              <input type="text" class="form-control" id="link_cron" name="link_cron" value="{{ route('cron.deposit.check', ['type' => 'vietcombank']) }}" readonly>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>AutoBank | Web2m | Acb</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'web2m_acb']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="account_number" class="form-label">Số Tài Khoản</label>
                <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $web2m_acb['account_number'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="account_password" class="form-label">Mật khẩu Bank</label>
                <input type="password" class="form-control" id="account_password" name="account_password" value="{{ $web2m_acb['account_password'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="api_token" class="form-label">API Token Web2m</label>
                <input type="text" class="form-control" id="api_token" name="api_token" value="{{ $web2m_acb['api_token'] ?? '' }}">
              </div>
            </div>
            <div class="mb-3">
              <label for="link_cron" class="form-label">Link Cron (manual)</label>
              <input type="text" class="form-control" id="link_cron" name="link_cron" value="{{ route('cron.deposit.check', ['type' => 'acb']) }}" readonly>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>AutoBank | Web2m | MBBank</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'web2m_mbbank']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="account_number" class="form-label">Số Tài Khoản</label>
                <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $web2m_mbbank['account_number'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="account_password" class="form-label">Mật khẩu Bank</label>
                <input type="password" class="form-control" id="account_password" name="account_password" value="{{ $web2m_mbbank['account_password'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="api_token" class="form-label">API Token Web2m</label>
                <input type="password" class="form-control" id="api_token" name="api_token" value="{{ $web2m_mbbank['api_token'] ?? '' }}">
              </div>
            </div>
            <div class="mb-3">
              <label for="link_cron" class="form-label">Link Cron (manual)</label>
              <input type="text" class="form-control" id="link_cron" name="link_cron" value="{{ route('cron.deposit.check', ['type' => 'mbbank']) }}" readonly>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>AutoBank | Web2m | MoMo</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'web2m_momo']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="api_token" class="form-label">API Token</label>
              <input type="text" class="form-control" id="api_token" name="api_token" value="{{ $web2m_momo['api_token'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="link_cron" class="form-label">Link Cron (manual)</label>
              <input type="text" class="form-control" id="link_cron" name="link_cron" value="{{ route('cron.deposit.check', ['type' => 'momo']) }}" readonly>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card custom-card">
        <div class="card-header justify-content-between">
          <h4 class="card-title">AutoBank | Perfect Money | USDT</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'perfect_money']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="account_id" class="form-label">Mã tài khoản</label>
              <input type="text" class="form-control" id="account_id" name="account_id" value="{{ $perfect_money['account_id'] ?? '' }}">
              <small>Vào đây để lấy mật mã tài khoản và đơn vị tiền tệ: <a href="https://perfectmoney.com/profile.html" target="_blank">https://perfectmoney.com/profile.html</a></small>
            </div>
            <div class="mb-3">
              <label for="passphrase" class="form-label">Mật khẩu Thay thế (Alternate Passphrase)</label>
              <input type="text" class="form-control" id="passphrase" name="passphrase" value="{{ $perfect_money['passphrase'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="exchange" class="form-label">Tỷ giá quy đổi 1$</label>
              <input type="text" class="form-control" id="exchange" name="exchange" value="{{ $perfect_money['exchange'] ?? 24000 }}">
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập Nhật</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card custom-card">
        <div class="card-header justify-content-between">
          <h4 class="card-title">AutoBank | FPayment | USDT</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'fpayment']) }}" method="POST">
            @csrf
            <div class="mb-3 row">
              <div class="col-md-4">
                <label for="address_wallet" class="form-label">Address Wallet</label>
                <input type="text" class="form-control" id="address_wallet" name="address_wallet" value="{{ $fpayment['address_wallet'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="token_wallet" class="form-label">Token Wallet</label>
                <input type="text" class="form-control" id="token_wallet" name="token_wallet" value="{{ $fpayment['token_wallet'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="exchange" class="form-label">Exchange VND</label>
                <input type="text" class="form-control" id="exchange" name="exchange" value="{{ $fpayment['exchange'] ?? 23000 }}">
              </div>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập Nhật</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card custom-card">
        <div class="card-header justify-content-between">
          <h4 class="card-title">AutoBank | Paypal | USDT</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'paypal']) }}" method="POST">
            @csrf
            <div class="mb-3 row">
              <div class="col-md-4">
                <label for="client_id" class="form-label">Client ID</label>
                <input type="text" class="form-control" id="client_id" name="client_id" value="{{ $paypal['client_id'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="client_secret" class="form-label">Client Secret</label>
                <input type="text" class="form-control" id="client_secret" name="client_secret" value="{{ $paypal['client_secret'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="exchange" class="form-label">Exchange VND</label>
                <input type="text" class="form-control" id="exchange" name="exchange" value="{{ $paypal['exchange'] ?? 23000 }}">
              </div>
              <input type="hidden" id="token" value="{{ auth()->user()->access_token }}" />
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary" type="submit">Cập Nhật</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>Charging Card | Card24h -> <a href="https://documenter.getpostman.com/view/5740908/TVYJ5Ggr" target="_blank">Hoặc tương tự</a></h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'charging_card']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              {{-- <div class="col-md-3">
                <label for="fees" class="form-label">Fees</label>
                <input type="text" class="form-control" id="fees" name="fees" value="{{ $charging_card['fees'] ?? 20 }}" placeholder="30">
              </div> --}}
              <div class="col-md-4">
                <label for="api_url" class="form-label">API Url</label>
                <input type="text" class="form-control" id="api_url" name="api_url" value="{{ $charging_card['api_url'] ?? 'https://card24h.com/' }}" placeholder="https://card24h.com/">
              </div>
              <div class="col-md-4">
                <label for="partner_id" class="form-label">Partner ID</label>
                <input type="text" class="form-control" id="partner_id" name="partner_id" value="{{ $charging_card['partner_id'] ?? '' }}">
              </div>
              <div class="col-md-4">
                <label for="partner_key" class="form-label">Partner Key</label>
                <input type="text" class="form-control" id="partner_key" name="partner_key" value="{{ $charging_card['partner_key'] ?? '' }}">
              </div>

            </div>
            <div class="row mb-3">
              <div class="col-md-3">
                <label for="fees_viettel" class="form-label">Phí Thẻ Viettel</label>
                <input type="text" class="form-control" id="fees_viettel" name="fees[VIETTEL]" value="{{ $charging_card['fees']['VIETTEL'] ?? 20 }}" placeholder="30">
              </div>
              <div class="col-md-3">
                <label for="fees_vinaphone" class="form-label">Phí Thẻ Vinaphone</label>
                <input type="text" class="form-control" id="fees_vinaphone" name="fees[VINAPHONE]" value="{{ $charging_card['fees']['VINAPHONE'] ?? 20 }}" placeholder="30">
              </div>
              <div class="col-md-3">
                <label for="fees_mobifone" class="form-label">Phí Thẻ Mobifone</label>
                <input type="text" class="form-control" id="fees_mobifone" name="fees[MOBIFONE]" value="{{ $charging_card['fees']['MOBIFONE'] ?? 20 }}" placeholder="30">
              </div>
              <div class="col-md-3">
                <label for="fees_zing" class="form-label">Phí Thẻ Zing</label>
                <input type="text" class="form-control" id="fees_zing" name="fees[ZING]" value="{{ $charging_card['fees']['ZING'] ?? 20 }}" placeholder="30">
              </div>
            </div>
            <div class="mb-3">
              <label for="link_cron" class="form-label">Link Callback (POST)</label>
              <input type="text" class="form-control" id="link_cron" name="link_cron" value="{{ route('cron.deposit.card-callback') }}" readonly>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>SMTP Mailer | <a href="https://www.cmsnt.co/2022/12/huong-dan-cach-cau-hinh-smtp-e-gui.html" target="_blank">Lấy thông tin SMTP</a></h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'smtp_detail']) }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-lg-6">
                <label for="host" class="form-label">SMTP Host</label>
                <input type="text" class="form-control" id="host" name="host" value="{{ $smtp_detail['host'] ?? '' }}">
              </div>
              <div class="col-lg-6">
                <label for="port" class="form-label">SMTP Port</label>
                <input type="number" class="form-control" id="port" name="port" value="{{ $smtp_detail['port'] ?? '' }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-6">
                <label for="user" class="form-label">SMTP User</label>
                <input type="text" class="form-control" id="user" name="user" value="{{ $smtp_detail['user'] ?? '' }}">
              </div>
              <div class="col-lg-6">
                <label for="pass" class="form-label">SMTP Pass</label>
                <input type="text" class="form-control" id="pass" name="pass" value="{{ $smtp_detail['pass'] ?? '' }}">
              </div>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
    </div>

    {{-- <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>Authentication | Facebook</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'auth_facebook']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="client_key" class="form-label">Client Key</label>
              <input type="text" class="form-control" id="client_key" name="client_key" value="{{ $auth_facebook['client_key'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="client_secret" class="form-label">Client Secret</label>
              <input type="text" class="form-control" id="client_secret" name="client_secret" value="{{ $auth_facebook['client_secret'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="redirect_url">Redirect URL</label>
              <input type="url" class="form-control" id="redirect_url" name="redirect_url" value="{{ route('auth.social.callback', ['provider' => 'facebook']) }}" readonly>
              <small>* Bỏ trống để tắt chức năng này</small>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>Authentication | Google</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.settings.apis.update', ['type' => 'auth_google']) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="client_key" class="form-label">Client Key</label>
              <input type="text" class="form-control" id="client_key" name="client_key" value="{{ $auth_google['client_key'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="client_secret" class="form-label">Client Secret</label>
              <input type="text" class="form-control" id="client_secret" name="client_secret" value="{{ $auth_google['client_secret'] ?? '' }}">
            </div>
            <div class="mb-3">
              <label for="redirect_url">Redirect URL</label>
              <input type="url" class="form-control" id="redirect_url" name="redirect_url" value="{{ route('auth.social.callback', ['provider' => 'google']) }}" readonly>
              <small>* Bỏ trống để tắt chức năng này</small>
            </div>
            <div class="mb-3 text-end">
              <button class="btn btn-primary mt-2" type="submit">Cập nhật ngay</button>
            </div>
          </form>
        </div>
      </div>
    </div> --}}
  </div>
@endsection
