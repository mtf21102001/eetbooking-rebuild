@extends('layouts.app')

@section('title', 'Register - Egypt Express Travel')

@section('content')
  <div class="min-h-screen flex items-center justify-center pt-20 pb-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
      <div class="text-center">
        <div
          class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-2xl mx-auto mb-4">
          <i class="fa-solid fa-user-plus"></i>
        </div>
        <h2 class="mt-2 text-3xl font-extrabold text-gray-900">Create a new account</h2>
        <p class="mt-2 text-sm text-gray-600">
          Already have an account?
          <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
            Sign in here
          </a>
        </p>
      </div>

      <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="rounded-md shadow-sm space-y-4">
          <!-- Name -->
          <div>
            <label for="name" class="sr-only">Full Name</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-user text-gray-400"></i>
              </div>
              <input id="name" name="name" type="text" autocomplete="name" required
                class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="Full Name" value="{{ old('name') }}">
            </div>
            @error('name')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="sr-only">Email address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-envelope text-gray-400"></i>
              </div>
              <input id="email" name="email" type="email" autocomplete="email" required
                class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="Email address" value="{{ old('email') }}">
            </div>
            @error('email')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="sr-only">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-lock text-gray-400"></i>
              </div>
              <input id="password" name="password" type="password" autocomplete="new-password" required
                class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="Password (8+ chars)">
            </div>
            @error('password')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div>
            <label for="password_confirmation" class="sr-only">Confirm Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-lock text-gray-400"></i>
              </div>
              <input id="password_confirmation" name="password_confirmation" type="password" required
                class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="Confirm Password">
            </div>
          </div>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-lg shadow-blue-500/30">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <i class="fa-solid fa-user-plus text-blue-300 group-hover:text-blue-100 transition"></i>
            </span>
            Register
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection