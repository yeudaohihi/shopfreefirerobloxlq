<div class="page-header">
  <div class="m-0 header-wrapper row">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Tivo .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="col-auto p-0 header-logo-wrapper">
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      <div class="logo-header-main"><a href="{{ route('home') }}">
          <img class="img-fluid for-light" src="{{ asset(setting('logo')) }}" style="width: 100%; height: 100%;">
          <img class="img-fluid for-dark" src="{{ asset(setting('logo')) }}" style="width: 100%; height: 100%;">
        </a>
      </div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      <div class="left-menu-header">
        <ul class="app-list"></ul>
        <ul class="header-left"></ul>
      </div>
    </div>
    <div class="p-0 nav-right col-6 pull-right right-header">
      <ul class="nav-menus">
        <div class="gtranslate_wrapper"></div>
        <li class="profile-nav onhover-dropdown">
          <div class="account-user"><i data-feather="user"></i></div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="javascript:$logout()"><i data-feather="log-out"> </i><span>Đăng xuất</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
          <div class="ProfileCard u-cf">
          <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="m-0 feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
          <div class="ProfileCard-details">
          <div class="ProfileCard-realName">{name}</div>
          </div>
          </div>
        </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>
