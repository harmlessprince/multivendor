@php
$isOrderActive = strpos(Route::currentRouteName(), 'orders.index') === 0 || strpos(Route::currentRouteName(), 'orders.edit') === 0 || strpos(Route::currentRouteName(), 'orders.show') === 0;
@endphp
<!-- Nav Item - Orders -->
<li class="nav-item  {{ $isOrderActive ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('orders.index') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Orders</span></a>
</li>
