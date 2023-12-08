<!-- DASHBOARD -->
<section class="sidebar-menu" id="main-menu">
    <h6 class="sidebar-heading p-2 mt-4 mb-1 bg-info text-light text-uppercase"><i class="bi-grid me-1"></i>Main Menu</h6>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard/"><i class="bi-speedometer2 me-2"></i>Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*sales*') ? 'active' : '' }}" href="{{ route('sales.index') }}"><i class="bi-graph-up me-2"></i>Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}"><i class="bi-tag me-2"></i>Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*products*') ? 'active' : '' }}" href="{{ route('products.index') }}"><i class="bi-box me-2"></i>Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*packages*') ? 'active' : '' }}" href="{{ route('packages.index') }}"><i class="bi-boxes me-2"></i>Package</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*users*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="bi-person-square me-2"></i>Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*reports*') ? 'active' : '' }}" href="{{ route('reports') }}"><i class="bi-archive me-2"></i>Report</a>
        </li>
    </ul>
</section>
