<x-guest-layout>
    <style>
        input[type="email"], input[type="password"] {
          padding: 10px 14px;
          border-radius: 8px;
          border: 1.5px solid #ddd;
          transition: border-color 0.3s ease;
          width: 100%;
          box-sizing: border-box;
        }
        input[type="email"]:focus, input[type="password"]:focus {
          border-color: #2563eb;
          outline: none;
          box-shadow: 0 0 5px rgba(37, 99, 235, 0.6);
        }
        button {
          background-color: #2563eb;
          color: white;
          font-weight: 700;
          padding: 12px 24px;
          border-radius: 8px;
          transition: background-color 0.3s ease;
          cursor: pointer;
          width: auto;
        }
        button:hover {
          background-color: #1d4ed8;
        }
        a.text-blue-600:hover {
          text-decoration: underline;
        }
        button.ripple {
          animation: ripple 0.3s linear;
        }
        @keyframes ripple {
          0% { transform: scale(1); }
          50% { transform: scale(0.95); }
          100% { transform: scale(1); }
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm
                              focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" 
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 
                          dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 
                          focus:ring-indigo-500 dark:focus:ring-offset-gray-800" 
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3" id="loginButton">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">
                Chưa có tài khoản? Đăng ký ngay
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('loginButton');
            btn.addEventListener('click', () => {
                btn.classList.add('ripple');
                setTimeout(() => btn.classList.remove('ripple'), 300);
            });
        });
    </script>
</x-guest-layout>
