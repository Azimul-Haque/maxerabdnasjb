<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('images/icon.png') }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-2">
        <span class="brand-text font-weight-light">বিজেএস এক্সাম</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
