<nav class="navbar navbar-expand-lg navbar-dark bg-success">
<div class="container-fluid">
    <!-- Brand / Logo -->


    <!-- Hamburger Toggler Button for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="adminNavbar">

      <!-- Left Links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mb-2">
                <a class="nav-link text-white fw-bold" href="{{route('home')}}">🏠 Online Pharmacy</a>
        </li>
        <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{route('dashboard')}}">📊 Dashboard</a>
        </li>


            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{route('index')}}"> 🏠Cashier POS</a>
            </li>
        {{-- <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('show_customer') }}">👥 Customers</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('show_user') }}">👥 Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('show_product') }}">💊 Medicines</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{route('category.index')}}">� Categories</a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('show_supplier') }}">🏭 Suppliers</a>
        </li>
        <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{route('orders.index')}}">💰 Orders</a>
            </li>
        {{-- <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('index_sales') }}">💰 Sales</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('index_purchase') }}">🛒 Purchases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('show_stock') }}">📦 Stock</a>
        </li>
        <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('admin_conversation') }}">💬 Customer Support</a>
            </li>
      </ul>

      <!-- Right User Dropdown -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()?->username ?? 'Username' }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">


            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  🚪 Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
