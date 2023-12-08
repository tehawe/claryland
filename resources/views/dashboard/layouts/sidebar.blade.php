<div class="sidebar border border-right col-sm-1 col-md-2 col-lg-2 p-0 pb-3 bg-info-subtle text-body">
    <div class="offcanvas-md offcanvas-end bg-info-subtle" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Claryland</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-1 overflow-y-auto">
            @include('dashboard.layouts.submenu.transaction')
            @can('admin')
                @include('dashboard.layouts.submenu.dashboard')
            @endcan
        </div>
    </div>
</div>
