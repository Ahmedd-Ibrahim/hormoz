<li class="{{ Request::is('*users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="fa fa-edit"></i><span>@lang('menu.Users')</span></a>
</li>


<li class="{{ Request::is('*credits*') ? 'active' : '' }}">
    <a href="{{ route('credits.index') }}"><i class="fa fa-edit"></i><span>Credits</span></a>
</li>


<li class="{{ Request::is('*categories*') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>


<li class="{{ Request::is('*subCategories*') ? 'active' : '' }}">
    <a href="{{ route('subCategories.index') }}"><i class="fa fa-edit"></i><span>Sub Categories</span></a>
</li>

<li class="{{ Request::is('*vendors*') ? 'active' : '' }}">
    <a href="{{ route('vendors.index') }}"><i class="fa fa-edit"></i><span>Vendors</span></a>
</li>

<li class="{{ Request::is('*addresses*') ? 'active' : '' }}">
    <a href="{{ route('addresses.index') }}"><i class="fa fa-edit"></i><span>Addresses</span></a>
</li>



<li class="{{ Request::is('*product*') ? 'active' : '' }}">
    <a href="{{ route('products.index') }}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>



<li class="{{ Request::is('*galleries*') ? 'active' : '' }}">
    <a href="{{ route('galleries.index') }}"><i class="fa fa-edit"></i><span>Galleries</span></a>
</li>


<li class="{{ Request::is('*orders*') ? 'active' : '' }}">
    <a href="{{ route('orders.index') }}"><i class="fa fa-edit"></i><span>Orders</span></a>
</li>


<li class="{{ Request::is('*userProducts*') ? 'active' : '' }}">
    <a href="{{ route('userProducts.index') }}"><i class="fa fa-edit"></i><span>User Products</span></a>
</li>



<li class="{{ Request::is('*orderProducts*') ? 'active' : '' }}">
    <a href="{{ route('orderProducts.index') }}"><i class="fa fa-edit"></i><span>Order Products</span></a>
</li>



<li class="{{ Request::is('*mailings*') ? 'active' : '' }}">
    <a href="{{ route('mailings.index') }}"><i class="fa fa-edit"></i><span>mailings</span></a>
</li>



<li class="{{ Request::is('*favorites*') ? 'active' : '' }}">
    <a href="{{ route('favorites.index') }}"><i class="fa fa-edit"></i><span>Favorites</span></a>
</li>

