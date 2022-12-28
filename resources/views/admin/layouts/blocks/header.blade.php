    <!-- Top app bar navigation menu-->
    <nav class="top-app-bar navbar navbar-expand navbar-dark bg-dark">
        <div class="container-fluid px-4">
            <!-- Drawer toggle button-->
            <button class="btn btn-lg btn-icon order-1 order-lg-0" id="drawerToggle" href="javascript:void(0);"><i class="material-icons">menu</i></button>
            <!-- Navbar brand-->
            {{-- <a class="navbar-brand me-auto" href="{{ route('admin.dashboard.index') }}"><div class="text-uppercase font-monospace">Dashboard</div></a>
            <a class="navbar-brand me-auto" href="{{ route('serviceCategories.index') }}"><div class="text-uppercase font-monospace">Web PM Automotive</div></a> --}}
            <!-- Navbar items-->
            <div class="d-flex align-items-center mx-3 me-lg-0">
                <!-- Navbar-->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item"><a class="nav-link" href="{{route('home.index')}}">На веб</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="https://docs.startbootstrap.com/material-admin-pro" target="_blank">Documentation</a></li> --}}
                </ul>
                <!-- Navbar buttons-->
                {{-- <form class="d-flex me-5 position-relative" role="search" action="{{ route('admin.dashboard.search_result') }}">
                    <input class="form-control me-2" name="query" value="{{ request('query') }}" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
                    <ul class="search-autocomplete-for-admin" id="admin_search_autocomplete">

                    </ul>
                    <button class="btn btn-outline-white-original d-none" type="submit"><i class="bi bi-search"></i></button>
                </form> --}}

                <div class="d-flex">
                    <!-- Messages dropdown-->
                    <div class="dropdown dropdown-notifications d-none d-sm-block">
                        <button class="btn btn-lg btn-icon dropdown-toggle me-3 position-relative" id="dropdownMenuMessages" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">mail_outline</i>

                        {{-- @if (count($last_contacts))
                            <div class="red-dot position-absolute text-danger"></div>
                        @endif --}}

                        </button>
                        {{-- <ul class="dropdown-menu dropdown-menu-end me-3 mt-3 py-0 overflow-hidden" aria-labelledby="dropdownMenuMessages">
                            <li><h6 class="dropdown-header bg-primary text-white fw-500 py-3">Messages</h6></li>
                            <li><hr class="dropdown-divider my-0" /></li>
                            @include('admin.layouts.blocks.lastMessages')

                        </ul> --}}
                    </div>
                    <!-- Notifications and alerts dropdown-->
                    {{-- <div class="dropdown dropdown-notifications d-none d-sm-block">
                        <button class="btn btn-lg btn-icon dropdown-toggle me-3" id="dropdownMenuNotifications" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">notifications</i></button>
                        <ul class="dropdown-menu dropdown-menu-end me-3 mt-3 py-0 overflow-hidden" aria-labelledby="dropdownMenuNotifications">
                            <li><h6 class="dropdown-header bg-primary text-white fw-500 py-3">Alerts</h6></li>
                            <li><hr class="dropdown-divider my-0" /></li>
                            <li>
                                <a class="dropdown-item unread" href="#!">
                                    <i class="material-icons leading-icon">assessment</i>
                                    <div class="dropdown-item-content me-2">
                                        <div class="dropdown-item-content-text">Your March performance report is ready to view.</div>
                                        <div class="dropdown-item-content-subtext">Mar 12, 2021 · Performance</div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-0" /></li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="material-icons leading-icon">check_circle</i>
                                    <div class="dropdown-item-content me-2">
                                        <div class="dropdown-item-content-text">Tracking codes successfully updated.</div>
                                        <div class="dropdown-item-content-subtext">Mar 12, 2021 · Coverage</div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-0" /></li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="material-icons leading-icon">warning</i>
                                    <div class="dropdown-item-content me-2">
                                        <div class="dropdown-item-content-text">Tracking codes have changed and require manual action.</div>
                                        <div class="dropdown-item-content-subtext">Mar 8, 2021 · Coverage</div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-0" /></li>
                            <li>
                                <a class="dropdown-item py-3" href="#!">
                                    <div class="d-flex align-items-center w-100 justify-content-end text-primary">
                                        <div class="fst-button small">View all</div>
                                        <i class="material-icons icon-sm ms-1">chevron_right</i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                    <!-- User profile dropdown-->
                    <div class="dropdown">
                        <button class="btn btn-lg btn-icon dropdown-toggle" id="dropdownMenuProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">person</i></button>
                        <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="dropdownMenuProfile">
                            <li>
                                {{-- <a class="dropdown-item" href="{{ route('admin.users.index') }}"> --}}
                                    <i class="material-icons leading-icon">person</i>
                                    <div class="me-3">Profile</div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="#!" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="material-icons leading-icon">logout</i>
                                    <div class="me-3">Logout</div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- <script>
        var log = console.log
        var results_count = 0;
        $('input[name="query"]').on('input', function(e) {
            if (this.value.length > 0) {
              $.get('/admin/search-api', {
                  query: this.value
              }, function(data) {
                    if(data.status && data.status === 'ok'){
                        results_count = data.results_count
                        $('#admin_search_autocomplete').html(data.search_list_html)
                    }
              })
            }else{
                $('#admin_search_autocomplete').html('')
            }
        })

        var activeIndex = -1
        $('input[name="query"]').on('keydown', function(e){
          if(e.which === 13 && $('#admin_search_autocomplete li.active').length){
              e.stopPropagation()
              $('#admin_search_autocomplete li.active a')[0].click()
              return false
          }
          $('#admin_search_autocomplete li.active').removeClass('active')
          if (e.which === 38 || e.which === 40) {
              if (e.which === 38) { // arrow up
                  activeIndex = in_range(activeIndex - 1, 0, results_count - 1)
              }
              if (e.which === 40) { // arrow down
                  activeIndex = in_range(activeIndex + 1, 0, results_count - 1)
              }
              $('#admin_search_autocomplete li.result-item').eq(activeIndex).addClass('active')
              return false
          }else{
              activeIndex = -1
          }
        })
        function in_range(num, min, max) {
            if(num < min) return max
            if(num > max) return min
            return num
        }

        $('input[name="query"]').focus(function(){
            document.body.classList.remove('ajax_loader')
            $('#admin_search_autocomplete').css('display', 'block')
        })

        $('body').on('click', function(e){
            if (!$(e.target).closest('#main_search_form').length && !$('input[name="query"]').length)
            {
                document.body.classList.add('ajax_loader')
                $('#admin_search_autocomplete').css('display', 'none')
            }
        })

    </script> --}}
