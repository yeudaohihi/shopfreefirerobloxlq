<!-- BEGIN: Sidebar -->
<div class="sidebar-wrapper group hidden w-0 xl:block xl:w-[248px]">
  <div id="bodyOverlay" class="fixed top-0 z-10 hidden h-screen w-screen bg-slate-900 bg-opacity-50 backdrop-blur-sm">
  </div>
  <div class="logo-segment">

    <!-- Application Logo -->
    <x-application-logo />

    <!-- Sidebar Type Button -->
    <div id="sidebar_type" class="cursor-pointer text-lg text-slate-900 dark:text-white">
      <iconify-icon class="sidebarDotIcon extend-icon text-slate-900 dark:text-slate-200" icon="fa-regular:dot-circle"></iconify-icon>
      <iconify-icon class="sidebarDotIcon collapsed-icon text-slate-900 dark:text-slate-200" icon="material-symbols:circle-outline"></iconify-icon>
    </div>
    <button class="sidebarCloseIcon inline-block text-2xl md:hidden">
      <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
    </button>
  </div>
  <div id="nav_shadow" class="nav_shadow nav-shadow pointer-events-none absolute top-[80px] z-[1] h-[60px] w-full opacity-0 transition-all duration-200"></div>
  <div class="sidebar-menus z-50 h-[calc(100%-80px)] bg-white px-4 py-2 dark:bg-slate-800" id="sidebar_menus">
    <ul class="sidebar-menu">
      <li class="sidebar-menu-title">{{ __t('MENU') }}</li>
      <li>
        <a href="{{ route('home') }}" class="navItem {{ request()->routeIs('home') ? 'active' : '' }}">
          <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="material-symbols:dashboard-outline"></iconify-icon>
            <span>{{ __t('Mua Tài Khoản') }}</span>
          </span>
        </a>
      </li>
      <li class="">
        <a href="javascript:void(0)" class="navItem">
          <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="humbleicons:cart"></iconify-icon>
            <span>{{ __t('Lịch Sử Mua Nick') }}</span>
          </span>
          <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('account.orders.accounts') }}" class="{{ request()->routeIs('account.orders.accounts') ? 'active' : '' }}">{{ __t('Tài Khoản Loại 1') }}</a>
          </li>
          <li>
            <a href="{{ route('account.orders.accounts-v2') }}" class="{{ request()->routeIs('account.orders.accounts-v2') ? 'active' : '' }}">{{ __t('Tài Khoản Loại 2') }}</a>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="javascript:void(0)" class="navItem">
          <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="tabler:lego"></iconify-icon>
            <span>{{ __t('Đơn Dịch Vụ Khác') }}</span>
          </span>
          <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('account.orders.boosting') }}" class="{{ request()->routeIs('account.orders.boosting') ? 'active' : '' }}">{{ __t('Lịch Sử Cày Thuê') }}</a>
          </li>
          <li>
            <a href="{{ route('account.withdraws.index') }}" class="{{ request()->routeIs('account.withdraws.index') ? 'active' : '' }}">{{ __t('Rút Thưởng Trò Chơi') }}</a>
          </li>
          <li>
            <a href="{{ route('account.orders.items') }}" class="{{ request()->routeIs('account.orders.items') ? 'active' : '' }}">{{ __t('Lịch Sử Mua Vật Phẩm') }}</a>
          </li>
        </ul>
      </li>

      <li>
        <a href="{{ route('account.profile.transactions') }}" class="navItem {{ request()->routeIs('account.profile.transactions') ? 'active' : '' }}">
          <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="ph:money"></iconify-icon>
            <span>{{ __t('Lịch Sử Giao Dịch') }}</span>
          </span>
        </a>
      </li>
      {{-- <li>
        <a href="{{ route('account.deposits.index') }}" class="navItem {{ request()->routeIs('account.deposits.index') ? 'active' : '' }}">
          <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="ph:credit-card-bold"></iconify-icon>
            <span>{{ __t('Nạp Tiền Tài Khoản') }}</span>
          </span>
        </a>
      </li> --}}
      <li class="">
        <a href="javascript:void(0)" class="navItem">
          <span class="flex items-center">
            <iconify-icon class=" nav-icon" icon="tabler:lego"></iconify-icon>
            <span>{{ __t('Nạp Tiền Tài Khoản') }}</span>
          </span>
          <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
          @php
            $deposit_port = Helper::getConfig('deposit_port');
          @endphp

          @if ($deposit_port['card'] ?? 0)
            <li>
              <a href="{{ route('account.deposits.index') }}" class="{{ request()->routeIs('account.deposits.index') ? 'active' : '' }}">{{ __t('Ngân Hàng') }}</a>
            </li>
          @endif
          @if ($deposit_port['paypal'] ?? 0)
            <li>
              <a href="{{ route('account.deposits.paypal') }}" class="{{ request()->routeIs('account.deposits.paypal') ? 'active' : '' }}">{{ __t('Cổng Paypal') }}</a>
            </li>
          @endif
          @if ($deposit_port['crypto'] ?? 0)
            <li>
              <a href="{{ route('account.deposits.crypto') }}" class="{{ request()->routeIs('account.deposits.crypto') ? 'active' : '' }}">{{ __t('Tiền Mã Hoá') }}</a>
            </li>
          @endif
          @if ($deposit_port['perfect_money'] ?? 0)
            <li>
              <a href="{{ route('account.deposits.perfect-money') }}" class="{{ request()->routeIs('account.deposits.perfect-money') ? 'active' : '' }}">{{ __t('Perfect Money') }}</a>
            </li>
          @endif

        </ul>
      </li>
      <li>
        <a href="{{ route('account.profile.index') }}" class="navItem {{ request()->routeIs('account.profile.index') ? 'active' : '' }}">
          <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="solar:user-broken"></iconify-icon>
            <span>{{ __t('Thông Tin Tài Khoản') }}</span>
          </span>
        </a>
      </li>
      <li>
        <a href="{{ route('articles.index') }}" class="navItem {{ request()->routeIs('articles.index') ? 'active' : '' }}">
          <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="fluent:form-new-48-regular"></iconify-icon>
            <span>{{ __t('Bài Viết Hướng Dẫn') }}</span>
          </span>
        </a>
      </li>

      @if (Auth::check() && Auth::user()->role === 'admin')
        <li>
          <a href="{{ route('admin.dashboard') }}" class="navItem {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="flex items-center">
              <iconify-icon class="nav-icon" icon="carbon:share"></iconify-icon>
              <span>{{ __t('Trang Quản Trị Viên') }}</span>
            </span>
          </a>
        </li>
      @elseif (Auth::check() && Auth::user()->role === 'collaborator')
        <li>
          <a href="{{ route('staff.dashboard') }}" class="navItem {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
            <span class="flex items-center">
              <iconify-icon class="nav-icon" icon="carbon:share"></iconify-icon>
              <span>{{ __t('Trang Cộng Tác Viên') }}</span>
            </span>
          </a>
        </li>
      @endif

    </ul>
  </div>
</div>
<!-- End: Sidebar -->
