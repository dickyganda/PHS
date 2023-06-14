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
            <li>
                <a href="/dashboard/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
                </a>
                {{-- <ul>
                    <li class="active">
                        <a href="intel_analytics_dashboard.html" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Analytics Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="intel_marketing_dashboard.html" title="Marketing Dashboard" data-filter-tags="application intel marketing dashboard">
                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard">Marketing Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="intel_introduction.html" title="Introduction" data-filter-tags="application intel introduction">
                            <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Introduction</span>
                        </a>
                    </li>
                    <li>
                        <a href="intel_privacy.html" title="Privacy" data-filter-tags="application intel privacy">
                            <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Privacy</span>
                        </a>
                    </li>
                </ul> --}}
            </li>
            <li>
                <a href="/sales/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Sales</span>
                </a>
            </li>

            <li>
            <a href="/bom/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">BOM</span>
                </a>
            </li>

            {{-- <li>
            <a href="/procurement/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Procurement</span>
                </a>
            </li> --}}

            <li>
            <a href="/purchasing/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Purchasing</span>
                </a>
            </li>

            <li>
            <a href="/issued/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Issued</span>
                </a>
            </li>

            <li>
            <a href="/finance/index" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Finance</span>
                </a>
            </li>

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