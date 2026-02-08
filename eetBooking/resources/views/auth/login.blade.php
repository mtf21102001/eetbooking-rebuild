<x-guest-layout>
  <div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
    <p class="text-soft">Sign in to continue your journey</p>
  </div>

  <!-- Session Status -->
  @if (session('status'))
    <div
      class="bg-indigo-500/20 border border-indigo-500/50 text-indigo-100 p-4 rounded-xl text-sm mb-6 backdrop-blur-md">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <!-- Email Address -->
    <div class="space-y-2">
      <x-input-label for="email" value="Email Address" class="text-white/80 ml-1" />
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fa-solid fa-envelope text-indigo-300 group-focus-within:text-white transition-colors"></i>
        </div>
        <input id="email" name="email" type="email" autocomplete="email" required autofocus
          class="auth-input block w-full pl-11 pr-4 py-3 rounded-xl sm:text-sm" placeholder="name@example.com"
          value="{{ old('email') }}">
      </div>
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="space-y-2">
      <div class="flex justify-between items-center">
        <x-input-label for="password" value="Password" class="text-white/80 ml-1" />
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-sm text-indigo-300 hover:text-white transition-colors">
            Forgot Password?
          </a>
        @endif
      </div>
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fa-solid fa-lock text-indigo-300 group-focus-within:text-white transition-colors"></i>
        </div>
        <input id="password" name="password" type="password" autocomplete="current-password" required
          class="auth-input block w-full pl-11 pr-4 py-3 rounded-xl sm:text-sm" placeholder="••••••••">
      </div>
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="flex items-center">
      <input id="remember_me" name="remember" type="checkbox"
        class="rounded border-white/20 bg-white/5 text-indigo-600 focus:ring-indigo-500 transition-colors cursor-pointer">
      <label for="remember_me" class="ml-2 text-sm text-soft cursor-pointer">Remember this device</label>
    </div>

    <div>
      <button type="submit"
        class="premium-btn w-full flex justify-center py-4 px-4 border border-transparent text-sm font-semibold rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Sign In
      </button>
    </div>

    <div class="text-center pt-4">
      <p class="text-soft text-sm">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-medium text-white hover:text-indigo-300 transition-colors">
          Join us today
        </a>
      </p>
    </div>
  </form>
</x-guest-layout>