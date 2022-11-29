 <!-- sidebar menu area start -->
 @php
 $usr = Auth::guard('admin')->user();
 @endphp

 <ul>
    @if ($usr->can('dashboard.view'))

    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    @endif

    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))

    <li><a href="{{ route('admin.roles.index') }}">Roles & Permissions</a></li>
    
    @endif

    @if ($usr->can('category.create') || $usr->can('category.view') ||  $usr->can('category.edit') ||  $usr->can('category.delete'))

    <li><a href="{{ route('admin.categories.index') }}">Category Management</a></li>
    @endif

    @if ($usr->can('product.create') || $usr->can('product.view') ||  $usr->can('product.edit') ||  $usr->can('product.delete'))

    <li><a href="{{ route('admin.products.index') }}">Product Management</a></li>
    @endif

    @if ($usr->can('user.create') || $usr->can('user.view') ||  $usr->can('user.edit') ||  $usr->can('user.delete'))

    <li><a href="{{ route('admin.users.index') }}">User Management</a></li>
    @endif
    
    @if ($usr->can('order.create') || $usr->can('order.view') ||  $usr->can('order.edit') ||  $usr->can('order.delete'))

    <li><a href="{{ route('admin.orders.index') }}">Order Management</a></li>
    @endif

    @if ($usr->can('stock.create') || $usr->can('stock.view') ||  $usr->can('stock.edit') ||  $usr->can('stock.delete'))

    <li><a href="{{ route('admin.stock.index') }}">Stocks</a></li>
    @endif

    @if ($usr->can('subadmin.create') || $usr->can('subadmin.view') ||  $usr->can('subadmin.edit') ||  $usr->can('subadmin.delete'))

    <li><a href="{{ route('admin.admins.index') }}">Sub Admin Management</a></li>
    @endif

</ul>

