<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <i class='bx bx-cube' style="font-size: 1.5rem"></i>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase;">GAD</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>


        {{-- @role(['super', 'admin', 'faculty', 'staff'])
        @endrole --}}

        <!-- Recording -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Recording</span>
        </li>
        <li class="menu-item {{ openSide(['schema', 'worksheet', 'category', 'preliminary']) }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Entry">Entry</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeSide('schema') }}">
                    <a href="/schema" class="menu-link">
                        <div data-i18n="Schema">Schema</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ activeSide('worksheet') }}">
                    <a href="/worksheet" class="menu-link">
                        <div data-i18n="Worksheet">Worksheet</div>
                    </a>
                </li> --}}

                @role(['super', 'admin'])
                    <li class="menu-item {{ activeSide('category') }}">
                        <a href="/category" class="menu-link">
                            <div data-i18n="Category">Category</div>
                        </a>
                    </li>
                    <li class="menu-item {{ activeSide('preliminary') }}">
                        <a href="/preliminary" class="menu-link">
                            <div data-i18n="Preliminary">Preliminary</div>
                        </a>
                    </li>
                @endrole
            </ul>
        </li>

        @role(['super', 'admin'])
            <!-- User -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">User</span>
            </li>
            <li class="menu-item {{ activeSide('user') }}">
                <a href="/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="User">User</div>
                </a>
            </li>
        @endrole

        @role(['super', 'admin'])
            <!-- Logs -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">History</span>
            </li>
            <li class="menu-item {{ openSide(['logs']) }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-history"></i>
                    <div data-i18n="Logs">Logs</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ activeSide('logs') }}">
                        <a href="/logs/activity" class="menu-link">
                            <div data-i18n="Activity log">Activity log</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole


        @role(['super', 'admin'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">System</span>
            </li>

            <li class="menu-item {{ openSide(['setting','general', 'webicon']) }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Setting">Setting</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ activeSide('general') }}">
                        <a href="/setting/general" class="menu-link">
                            <div data-i18n="General">General</div>
                        </a>
                    </li>
                    <li class="menu-item {{ activeSide('webicon') }}">
                        <a href="/setting/webicon" class="menu-link">
                            <div data-i18n="Web Icon">Web Icon</div>
                        </a>
                    </li>
                </ul>
            </li>
            @role(['super'])
                <li class="menu-item {{ activeSide('backup') }}">
                    <a href="/backup" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-hdd"></i>
                        <div data-i18n="Backup">Backup</div>
                    </a>
                </li>

                <li class="menu-item {{ activeSide('maintenance') }}">
                    <a href="/maintenance" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-chip"></i>
                        <div data-i18n="Maintenance">Maintenance</div>
                    </a>
                </li>
                @endrole
        @endrole

        @role(['user'])
            <li class="menu-item {{ activeSide('profile') }}">
                <a href="/my/profile" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="My Profile">My Profile</div>
                </a>
            </li>
            <li class="menu-item {{ activeSide('password') }}">
                <a href="/my/password" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-lock-alt"></i>
                    <div data-i18n="My Password">My Password</div>
                </a>
            </li>
        @endrole
    </ul>
</aside>

