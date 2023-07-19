<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ asset('assets/img/logo.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{ asset('assets/img/demo/avatars/avatar-admin.png') }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        Dr. Codex Lantern
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span>
            </div>
            <img src="{{ asset('assets/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            @php
            use Illuminate\Support\Facades\Session;

                $sessiondatamenu = Session::get('datamenu');
                $sessionmenu = Session::get('menu');
                @endphp

                @foreach ($sessionmenu as $itemmenu )

                    <li class="active open">
                        <a href="{{ $itemmenu->Url }}" data-filter-tags="application intel">
                            <i class="{{ $itemmenu->IconMenu }}"></i>
                            <span class="nav-link-text" data-i18n="nav.application_intel">{{ $itemmenu->NamaMenu }}</span>
                        </a>
                        <ul>
                
                        @foreach ($sessiondatamenu as $itemdatamenu)
                            {{-- jika punya parent --}}
                            @if($itemdatamenu->MainMenu == $itemmenu->IdMenu && $itemdatamenu->Index == 1)
                                <li>
                                    <a href={{ $itemdatamenu->Url }} title="Application Intel" data-filter-tags="application intel">
                                        {{-- <i class="{{ $itemdatamenu->IconMenu }}"></i> --}}
                                        <span class="nav-link-text" data-i18n="nav.application_intel">{{ $itemdatamenu->NamaMenu }}</span>
                                    </a>
                                </li>                                
                            @endif

                        @endforeach

                        </ul>
                    </li>

                @endforeach

            @foreach ($sessiondatamenu as $itemdatamenu)
                {{-- jika punya parent --}}
                @if($itemdatamenu->MainMenu === '0' && $itemdatamenu->Index == 1)
                    <li>
                        <a href={{ $itemdatamenu->Url }} title="Application Intel" data-filter-tags="application intel">
                            <i class="{{ $itemdatamenu->IconMenu }}"></i>
                            <span class="nav-link-text" data-i18n="nav.application_intel">{{ $itemdatamenu->NamaMenu }}</span>
                        </a>
                    </li>                                
                @endif

            @endforeach

        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>