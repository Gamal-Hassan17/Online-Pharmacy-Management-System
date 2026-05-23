<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'Pharmacy')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
   body {
  font-family: 'Cairo', sans-serif;
  background-color: #f9f9f9;
  color: #333;
  line-height: 1.6;
  padding-top: 80px; /* بسبب navbar الثابت */
}

/* ========== Navbar ثابت ========== */
.navbar {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1050;
  background-color: #fff !important;
  border-bottom: 1px solid #ddd;
}
.d-flex::-webkit-scrollbar {
    height: 2px;
}

.d-flex::-webkit-scrollbar-thumb {
    background: #198754;
    border-radius: 10px;
}

/* ========== العناوين ========== */
h1, h2, h3, h4, h5 {
  font-weight: 700;
  color: #28a745;
}

.section-title {
  font-size: 32px;
  margin-bottom: 30px;
  color: #28a745;
  text-align: center;
}

/* ========== الأزرار ========== */
.btn-success {
  background-color: #28a745;
  border: none;
  border-radius: 25px;
  padding: 10px 25px;
  font-weight: bold;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background-color: #1e7e34;
  transform: scale(1.05);
}

/* ========== الكروت ========== */
.card {
  border-radius: 16px;
  transition: all 0.3s ease;
}
/* توسيط المحتوى في الكروت */
.card {
  text-align: center;
  justify-content: center;
  align-items: center;
  display: flex;
  flex-direction: column;
}


.card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

/* ========== صور الأقسام ========== */
.category-icon {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 50%;
}

/* ========== تأثير عند الضغط ========== */
.clickable:hover {
  cursor: pointer;
  transform: scale(1.03);
  transition: 0.3s ease;
}

.clickable:active {
  transform: scale(0.98);
}

/* ========== الفوتر ========== */


  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
      🏥 Pharmacy
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- القائمة اليسرى -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('all_pro') }}">💊 Medicines</a>
        </li>

        <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('customer.cart') }}">🛒 Cart</a>
        </li>
         <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('my.orders') }}"> 📋My Order</a>
        </li>


      </ul>

      <!-- خانة البحث -->
      <form action="{{ route('medicines.index') }}" method="GET" class="d-flex me-3" style="max-width: 350px;">
        <input class="form-control me-2" type="search" name="search" placeholder="Search for medicine..." value="{{ request('search') }}">
        <button class="btn btn-outline-success" type="submit">🔍</button>
      </form>

      <!-- تسجيل الدخول والخروج -->
      <ul class="navbar-nav">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.login') }}">🔐 Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">📝 Register</a>
          </li>

        @else
        @if(auth()->user() && auth()->user()->role === 'admin')
        <li class="nav-item">
        <a class="nav-link fw-semibold text-primary" href="{{ route('dashboard') }}">📊 Dashboard</a>
        </li>
        <li class="nav-item ">
                <a class="nav-link  fw-semibold text-primary" href="{{route('index')}}"> 🏠Cashier POS</a>
        </li>
    @endif
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('user.profile') }}">👤 My Account</a>
          </li> --}}
          <li class="nav-item d-flex align-items-center">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="nav-link btn btn-link text-danger fw-semibold p-0">
                🚪 Logout
              </button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>


  <main class="py-4">
    @yield('content')
  </main>

  <footer class="footer mt-auto py-3 border-top text-center bg-light">
        <div class="container">
            <span class="fw-bold text-success footer-name">Gamal Hassan</span><br>
            <span class="text-muted footer-desc">
                3rd year Computer Science | Web Developer
            </span>
        </div>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
