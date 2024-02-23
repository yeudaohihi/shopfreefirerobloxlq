<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}">
        <img class="img-fluid for-light" style="width: 76%; height: 60px;" src="/_assets/images/cmsnt_dark.png" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="{{ route('admin.dashboard') }}">
        <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
      </a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn">
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="pin-title sidebar-list">
            <h6>Pinned</h6>
          </li>
          <hr>
          <li class="sidebar-list">
            <i class="fa fa-thumb-tack"></i>
            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
              <i data-feather="home"> </i><span>Bảng điều khiển</span>
            </a>
          </li>
          @if (auth()->user()->role === 'admin')
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.settings.general') }}">
                <i data-feather="settings"> </i><span>Cài đặt chung</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.settings.apis') }}">
                <i data-feather="link"> </i><span>Cài đặt api keys</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.settings.notices') }}">
                <i data-feather="share-2"> </i><span>Cài đặt thông báo</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.users') }}">
                <i data-feather="users"> </i><span>Quản lý thành viên</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.banks') }}">
                <i data-feather="credit-card"> </i><span>Quản lý TK N.Hàng</span>
              </a>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.histories') }}">
                <i data-feather="list"> </i><span>Lịch sử hoạt động</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.transactions') }}">
                <i data-feather="list"> </i><span>Quản lý giao dịch</span>
              </a>
            </li>

            {{-- <li class="sidebar-list">
            <i class="fa fa-thumb-tack"></i>
            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.invoices') }}">
              <i data-feather="list"> </i><span>Quản lý hoá đơn</span>
            </a>
          </li> --}}

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.cards') }}">
                <i data-feather="link"> </i><span>Quản lý thẻ cào</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.posts') }}">
                <i data-feather="share"> </i><span>Quản lý bài viết</span>
              </a>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.games.spin-quest') }}">
                <i data-feather="link"> </i><span>Trò chơi Spin Quest</span>
              </a>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.games.withdraws') }}">
                <i data-feather="link"> </i><span>Quản lý trả thưởng</span>
              </a>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <i data-feather="cloud"></i>
                <span>Dịch vụ cày thuê</span>
              </a>
              <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.boosting.orders') }}">Quản lý đơn hàng <span class="badge bg-danger">{{ \App\Models\GBOrder::where('status', 'Pending')->count() }}</span></a></li>
                <li><a href="{{ route('admin.boosting.categories') }}">Quản lý chuyên mục</a></li>
              </ul>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <i data-feather="cloud"></i>
                <span>Quản lý shop nick</span>
              </a>
              <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.accounts.items', ['sold' => 1]) }}">Quản lý đơn hàng <span class="badge bg-danger">{{ \App\Models\ListItem::where('buyer_name', null)->count() }}</span></a></li>
                <li><a href="{{ route('admin.accounts.items', ['sold' => 0]) }}">Quản lý tài khoản</a></li>
                <li><a href="{{ route('admin.accounts.categories') }}">Quản lý chuyên mục</a></li>
              </ul>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <i data-feather="cloud"></i>
                <span>Quản lý shop nick2</span>
              </a>
              <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.accountsv2.items', ['sold' => 1]) }}">Quản lý đơn hàng <span class="badge bg-danger">{{ \App\Models\ResourceV2::where('buyer_name', null)->count() }}</span></a></li>
                <li><a href="{{ route('admin.accountsv2.categories') }}">Quản lý chuyên mục</a></li>
              </ul>
            </li>

            <li class="sidebar-list">
              <i class="fa fa-thumb-tack"></i>
              <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <i data-feather="cloud"></i>
                <span>Quản lý shop items</span>
              </a>
              <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.items.orders') }}">Quản lý đơn hàng <span class="badge bg-danger">{{ \App\Models\ItemOrder::count() }}</span></a></li>
                <li><a href="{{ route('admin.items.categories') }}">Quản lý chuyên mục</a></li>
              </ul>
            </li>
          @endif

        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
