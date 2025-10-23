<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | Admin Panel</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white p-4 shadow">
      <h2 class="font-bold text-xl mb-6">Admin Panel</h2>
      <nav class="space-y-2">
        <a href="{{ route('admin.products.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.products.*') ? 'bg-gray-200' : '' }}">
          Sản phẩm
        </a>
        <a href="{{ route('admin.orders.index') }}"
           class="block px-3 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-200' : '' }}">
          Đơn hàng
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
          @csrf
          <button type="submit" class="w-full text-left text-red-600 hover:text-red-800">
            Logout
          </button>
        </form>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6">
      @if(session('success'))
        <div class="bg-green-100 p-3 mb-4">{{ session('success') }}</div>
      @endif
      @yield('content')
    </main>
  </div>
</body>
</html>
