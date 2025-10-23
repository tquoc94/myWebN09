<nav class="bg-white border-b border-gray-100" x-data="{ open: false }">
<style>
  nav.bg-white {
    background: linear-gradient(90deg, #ff3333 0%, #ffb347 100%) !important;
    border-bottom: 2px solid #dc2626 !important;
    box-shadow: 0 4px 16px rgba(255,51,51,0.08);
  }
  .max-width-nav-fix {
    max-width: 1400px;
    margin: 0 auto;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    box-sizing: border-box;
  }
  .nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-height: 64px;
  }
  .logo {
    min-width: 150px;
  }
  .desktop-nav {
    display: flex;
    align-items: center;
    flex: 1;
    justify-content: flex-end;
    gap: 1rem;
  }
  .nav-link {
    color: #fff !important;
    font-weight: 600;
    padding: 8px 15px;
    border-radius: 6px;
    transition: background 0.19s, color 0.19s;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    height: 40px;
    text-decoration: none;
  }
  .nav-link.active, .nav-link[aria-current="page"] {
    background: #fff6 !important;
    color: #222 !important;
  }
  .nav-link:hover {
    color: #ffe047 !important;
    background: rgba(0,0,0,0.04);
  }
  nav input[type="text"] {
    background: #fffecb !important;
    border: 1.5px solid #fde047 !important;
    color: #8a5800 !important;
    border-radius: 8px;
    padding: 7px 14px;
    font-size: 1rem;
    margin-right: 8px;
    outline: none;
    height: 40px;
    box-sizing: border-box;
    transition: border-color 0.2s, background 0.2s;
  }
  nav input[type="text"]:focus {
    border-color: #facc15 !important;
    background: #fff9c4 !important;
  }
  nav button[type="submit"] {
    background: #2563eb !important;
    color: #fff !important;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    transition: background 0.18s, box-shadow 0.18s, transform 0.13s;
    box-shadow: 0 2px 8px rgba(37,99,235,0.08);
    margin-right: 12px;
    margin-left: 0;
    height: 40px;
    cursor: pointer;
  }
  nav button[type="submit"]:hover {
    background: #1d4ed8 !important;
  }
  nav button.ripple {
    animation: ripple 0.28s linear;
  }
  @keyframes ripple {
    0% { transform: scale(1);}
    40% { transform: scale(0.95);}
    100% { transform: scale(1);}
  }
  .nav-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-left: 1rem;
  }
  /* Tên tài khoản + dropdown */
  .account-wrapper {
    position: relative;
    margin-left: 1.2rem;
    height: 40px;
  }
  .account-name {
    color: #222;
    font-weight: 700;
    background: #fff6;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: 1rem;
    letter-spacing: 0.02em;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    white-space: nowrap;
    height: 40px;
    line-height: 26px;
    cursor: pointer;
    display: flex;
    align-items: center;
    user-select: none;
  }
  .account-dropdown {
    position: absolute;
    top: 48px;
    right: 0;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 150px;
    z-index: 1000;
    display: none;
    flex-direction: column;
  }
  .account-dropdown.show {
    display: flex;
  }
  .account-dropdown form button {
    border: none;
    background: transparent;
    padding: 12px 20px;
    width: 100%;
    text-align: left;
    font-weight: 600;
    color: #dc2626;
    cursor: pointer;
    border-radius: 0 0 8px 8px;
    transition: background-color 0.2s ease;
  }
  .account-dropdown form button:hover {
    background: #fee2e2;
  }
  @media (max-width: 900px) {
    .desktop-nav { display: none !important;}
    .mobile-nav { display: flex !important;}
    .account-wrapper {
      margin: 0.7rem 0;
      height: auto;
    }
    .account-dropdown {
      position: static;
      box-shadow: none;
      border-radius: 0;
      background: transparent;
      display: block !important;
      padding-left: 0;
      padding-top: 0.5rem;
    }
    .account-dropdown form button {
      padding: 8px 0;
      color: #dc2626;
      font-weight: 600;
      background: none;
      border-radius: 0;
    }
    .account-dropdown form button:hover {
      background: transparent;
      text-decoration: underline;
    }
  }
  @media (min-width: 900px) {
    .mobile-nav { display: none !important;}
    .desktop-nav { display: flex !important;}
  }
</style>

<div class="max-width-nav-fix">
  <div class="nav-container">
    <!-- Logo -->
    <div class="logo flex-shrink-0 flex items-center" style="min-width:150px;">
      <a href="{{ route('home') }}" class="text-white text-xl font-bold nav-link" style="background:none;">🍊 FruitShop</a>
    </div>

    <!-- Desktop Navigation -->
    <div class="desktop-nav">
      <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="{{ request()->routeIs('home') ? 'page' : '' }}">Home</a>
      <a href="{{ route('importedFruits') }}" class="nav-link {{ request()->routeIs('importedFruits') ? 'active' : '' }}" aria-current="{{ request()->routeIs('importedFruits') ? 'page' : '' }}">Trái cây nhập khẩu</a>
      <a href="{{ route('localFruits') }}" class="nav-link {{ request()->routeIs('localFruits') ? 'active' : '' }}" aria-current="{{ request()->routeIs('localFruits') ? 'page' : '' }}">Trái cây Việt Nam</a>
      <a href="{{ route('products.promotion') }}" class="nav-link {{ request()->routeIs('products.promotion') ? 'active' : '' }}" aria-current="{{ request()->routeIs('products.promotion') ? 'page' : '' }}">Khuyến mãi</a>


      <div class="nav-actions">
        <form method="GET" action="{{ route('products.search') }}" class="flex items-center" style="margin-bottom:0;">
          <input type="text" name="search" id="search" placeholder="Tìm sản phẩm..." autocomplete="off">
          <button type="submit" id="search-btn">Tìm kiếm</button>
        </form>

        @auth
        <div class="account-wrapper" id="accountWrapper">
          <div class="account-name" id="accountName">{{ Auth::user()->name }}</div>
          <div class="account-dropdown" id="accountDropdown">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit">Đăng xuất</button>
            </form>
          </div>
        </div>
        @else
          <a href="{{ route('login') }}" class="nav-link">Đăng nhập</a>
          <a href="{{ route('register') }}" class="nav-link">Đăng ký</a>
        @endauth
      </div>
    </div>

    <!-- Mobile Hamburger -->
    <div class="mobile-nav flex items-center">
      <button onclick="toggleMobileNav()" class="text-white focus:outline-none text-3xl px-2" aria-label="Toggle menu">&#9776;</button>
    </div>
  </div>

  <!-- Mobile Navigation Menu -->
  <div id="mobileNavPanel" class="w-full bg-white rounded-b shadow-md px-2 py-3" style="display:none;">
    <a href="{{ route('home') }}" class="block nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
    <a href="{{ route('importedFruits') }}" class="block nav-link {{ request()->routeIs('importedFruits') ? 'active' : '' }}">Trái cây nhập khẩu</a>
    <a href="{{ route('localFruits') }}" class="block nav-link {{ request()->routeIs('localFruits') ? 'active' : '' }}">Trái cây Việt Nam</a>
    <a href="{{ route('products.promotion') }}" class="block nav-link {{ request()->routeIs('products.promotion') ? 'active' : '' }}">Khuyến mãi</a>

    <form method="GET" action="{{ route('products.search') }}" class="flex items-center mt-2 mb-2">
      <input type="text" name="search" id="search-mobile" placeholder="Tìm sản phẩm..." autocomplete="off">
      <button type="submit" id="search-btn-mobile">Tìm</button>
    </form>
    @auth
      <div class="account-wrapper" style="margin:0.7rem 0;">
        <div class="account-name" id="accountNameMobile">{{ Auth::user()->name }}</div>
        <div class="account-dropdown" id="accountDropdownMobile" style="display:none;">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Đăng xuất</button>
          </form>
        </div>
      </div>
    @else
      <a href="{{ route('login') }}" class="block nav-link">Đăng nhập</a>
      <a href="{{ route('register') }}" class="block nav-link">Đăng ký</a>
    @endauth
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btns = [document.getElementById('search-btn'), document.getElementById('search-btn-mobile')];
    btns.forEach(btn => {
      if (btn) {
        btn.addEventListener('click', function() {
          btn.classList.add('ripple');
          setTimeout(() => btn.classList.remove('ripple'), 250);
        });
      }
    });

    // Desktop dropdown toggle
    const accountName = document.getElementById('accountName');
    const accountDropdown = document.getElementById('accountDropdown');
    const accountWrapper = document.getElementById('accountWrapper');

    if (accountName && accountDropdown && accountWrapper) {
      accountName.addEventListener('click', () => {
        accountDropdown.classList.toggle('show');
      });

      document.addEventListener('click', (e) => {
        if (!accountWrapper.contains(e.target)) {
          accountDropdown.classList.remove('show');
        }
      });
    }

    // Mobile dropdown toggle
    const accountNameMobile = document.getElementById('accountNameMobile');
    const accountDropdownMobile = document.getElementById('accountDropdownMobile');

    if (accountNameMobile && accountDropdownMobile) {
      accountNameMobile.addEventListener('click', () => {
        accountDropdownMobile.style.display = accountDropdownMobile.style.display === 'flex' ? 'none' : 'flex';
      });

      document.addEventListener('click', (e) => {
        if (accountDropdownMobile && !accountDropdownMobile.contains(e.target) && e.target !== accountNameMobile) {
          accountDropdownMobile.style.display = 'none';
        }
      });
    }
  });

  function toggleMobileNav() {
    var nav = document.getElementById('mobileNavPanel');
    nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
  }

  document.addEventListener('click', function(e) {
    var nav = document.getElementById('mobileNavPanel');
    var btn = document.querySelector('.mobile-nav button');
    if (!nav || !btn) return;
    if (nav.style.display === 'block' && !nav.contains(e.target) && !btn.contains(e.target)) {
      nav.style.display = 'none';
    }
  });
</script>
</nav>
