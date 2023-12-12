<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        @section('sidebar')
            {{-- <li><a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li><a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Criteria</span></a></li>
            <li><a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Alternatif</span></a></li>
            <li><a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Alternatif Value</span></a></li>
            <li><a href="#" class="nav-link"><i class="fas fa-fire"></i><span>calculation process</span></a></li> --}}
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Processing</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">Data Alternatif</a></li>
                    <li><a class="nav-link" href="index.html">Data Alternatif & Value</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Vikor Result</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
        @show
    </ul>
    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
        </a>
    </div>
</aside>
