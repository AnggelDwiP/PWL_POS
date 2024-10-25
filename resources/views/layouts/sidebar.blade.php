<div class="sidebar">
  <!-- Sidebar Menu --> 
  <nav class="mt-2"> 
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
      <!-- Dashboard accessible by all authenticated users -->
      <li class="nav-item"> 
        <a href="{{ url('/dashboard') }}" class="nav-link  {{ ($activeMenu == 'dashboard')? 'active' : '' }} "> 
          <i class="nav-icon fas fa-tachometer-alt"></i> 
          <p>Dashboard</p> 
        </a> 
      </li> 

      @if(auth()->user()->level->level_kode == 'ADM' || auth()->user()->level->level_kode == 'MNG')
      <!-- Data Pengguna section only for ADM and MNG -->
      <li class="nav-header">Data Pengguna</li> 
      @if(auth()->user()->level->level_kode == 'ADM')
      <li class="nav-item"> 
        <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level')? 'active' : '' }} "> 
          <i class="nav-icon fas fa-layer-group"></i> 
          <p>Level User</p> 
        </a> 
      </li> 
      @endif
      <li class="nav-item"> 
        <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user')? 'active' : '' }}"> 
          <i class="nav-icon far fa-user"></i> 
          <p>Data User</p> 
        </a> 
      </li> 
      @endif

      <!-- Data Barang section -->
      <li class="nav-header">Data Barang</li> 
      @if(auth()->user()->level->level_kode != 'CUS')
      <li class="nav-item"> 
        <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori')? 'active' : '' }} "> 
          <i class="nav-icon far fa-bookmark"></i> 
          <p>Kategori Barang</p> 
        </a> 
      </li> 
      @endif

      <li class="nav-item"> 
        <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang')? 'active' : '' }} "> 
          <i class="nav-icon far fa-list-alt"></i> 
          <p>Data Barang</p> 
        </a> 
      </li> 

      @if(auth()->user()->level->level_kode == 'ADM' || auth()->user()->level->level_kode == 'MNG')
      <li class="nav-item"> 
        <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier')? 'active' : '' }} "> 
          <i class="nav-icon fas fa-truck"></i> 
          <p>Data Supplier</p> 
        </a> 
      </li> 
      @endif

      <!-- Data Transaksi section -->
      <li class="nav-header">Data Transaksi</li> 
      @if(auth()->user()->level->level_kode != 'CUS')
      <li class="nav-item"> 
        <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok')? 'active' : '' }} "> 
          <i class="nav-icon fas fa-cubes"></i> 
          <p>Stok Barang</p> 
        </a> 
      </li> 
      @endif

      <li class="nav-item"> 
        <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan')? 'active' : '' }} "> 
          <i class="nav-icon fas fa-cash-register"></i> 
          <p>Transaksi Penjualan</p> 
        </a> 
      </li> 
    </ul> 
  </nav>
</div>