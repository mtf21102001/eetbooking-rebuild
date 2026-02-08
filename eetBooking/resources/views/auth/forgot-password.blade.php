<x-guest-layout>
  <div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-white mb-2">Password Recovery</h2>
    <p class="text-soft">Enter your email to receive a reset link</p>
  </div>

  <!-- Session Status -->
  @if (session('status'))
    <div
      class="bg-indigo-500/20 border border-indigo-500/50 text-indigo-100 p-4 rounded-xl text-sm mb-6 backdrop-blur-md">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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

    <div>
      <button type="submit"
        class="premium-btn w-full flex justify-center py-4 px-4 border border-transparent text-sm font-semibold rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Send Reset Link
      </button>
    </div>

    <div class="text-center pt-4">
      <a href="{{ route('login') }}"
        class="inline-flex items-center gap-2 text-soft hover:text-white transition-colors text-sm">
        <i class="fa-solid fa-arrow-left text-xs"></i>
        Back to Login
      </a>
    </div>
  </form>
</x-guest-layout>