<!-- TRANSACTION -->
<section class="sidebar-menu" id="transaction">
    <h6 class="sidebar-heading p-2 mt-4 mb-1 bg-info bg-gradient text-light text-uppercase">
        <i class="bi-shop me-1"></i>Transaction
    </h6>
    <ul class="nav flex-column text-body">
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*orders') ? 'active' : '' }}" href="{{ route('orders') }}"><i class="bi-cart me-2"></i>Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*ticket*') ? 'active' : '' }}" href="{{ route('orders.ticket') }}"><i class="bi-ticket me-2"></i>Ticket</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*sales*') ? 'active' : '' }}" href="{{ route('sales.index') }}"><i class="bi-graph-up me-2"></i>Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-block rounded {{ Request::is('*settlements*') ? 'active' : '' }}" href="{{ route('settlements') }}"><i class="bi-journal-arrow-up me-2"></i>Settlement</a>
        </li>
    </ul>
</section>
