<x-guest-layout>
  <div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
    <p class="text-soft">Join EET Booking and start your adventure</p>
  </div>

  <form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    <!-- Name -->
    <div class="space-y-2">
      <x-input-label for="name" value="Full Name" class="text-white/80 ml-1" />
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fa-solid fa-user text-indigo-300 group-focus-within:text-white transition-colors"></i>
        </div>
        <input id="name" name="name" type="text" autocomplete="name" required autofocus
          class="auth-input block w-full pl-11 pr-4 py-3 rounded-xl sm:text-sm" placeholder="John Doe"
          value="{{ old('name') }}">
      </div>
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="space-y-2">
      <x-input-label for="email" value="Email Address" class="text-white/80 ml-1" />
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fa-solid fa-envelope text-indigo-300 group-focus-within:text-white transition-colors"></i>
        </div>
        <input id="email" name="email" type="email" autocomplete="email" required
          class="auth-input block w-full pl-11 pr-4 py-3 rounded-xl sm:text-sm" placeholder="name@example.com"
          value="{{ old('email') }}">
      </div>
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="space-y-2">
      <x-input-label for="password" value="Password" class="text-white/80 ml-1" />
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fa-solid fa-lock text-indigo-300 group-focus-within:text-white transition-colors"></i>
        </div>
        <input id="password" name="password" type="password" autocomplete="new-password" required
          class="auth-input block w-full pl-11 pr-4 py-3 rounded-xl sm:text-sm" placeholder="••••••••">
      </div>
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="space-y-2">
      <x-input-label for="password_confirmation" value="Confirm Password" class="text-white/80 ml-1" />
      <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fa-solid fa-shield-check text-indigo-300 group-focus-within:text-white transition-colors"></i>
        </div>
        <input id="password_confirmation" name="password_confirmation" type="password" required
          class="auth-input block w-full pl-11 pr-4 py-3 rounded-xl sm:text-sm" placeholder="••••••••">
      </div>
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="pt-2">
      <button type="submit"
        class="premium-btn w-full flex justify-center py-4 px-4 border border-transparent text-sm font-semibold rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Create Account
      </button>
    </div>

    <div class="text-center pt-4">
      <p class="text-soft text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="font-medium text-white hover:text-indigo-300 transition-colors">
          Sign in here
        </a>
      </p>
    </div>
  </form>
</x-guest-layout>