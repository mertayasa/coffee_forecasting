<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
<div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
</div>
<div class="sidebar-brand-text mx-3">Toyota Smile</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{Request::is('/') ? 'active' : ''}}">
<a class="nav-link" href="index.html">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<li class="nav-item {{Request::is('product*') ? 'active' : ''}}">
<a class="nav-link" href="{{route('product.index')}}">
    <i class="fas fa-shopping-bag"></i>
    <span>Produk</span></a>
</li>

<li class="nav-item {{Request::is('product_category*') ? 'active' : ''}}">
<a class="nav-link" href="{{route('product_category.index')}}">
    <i class="fas fa-layer-group"></i>
    <span>Kategori</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForecast" aria-expanded="true" aria-controls="collapseForecast">
    <i class="fas fa-chart-bar"></i>
    <span>Peramalan</span>
</a>
<div id="collapseForecast" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Manajemen Peramalan:</h6>
    <a class="collapse-item" href="{{route('actual_data.index')}}">Data Aktual</a>
    <a class="collapse-item" href="cards.html">Peramalan</a>
    </div>
</div>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">