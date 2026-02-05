@extends('layouts.app')

@section('title', 'My Dashboard - Egypt Express Travel')

@section('content')
  <div class="min-h-screen pt-24 pb-12 px-4 sm:px-6 lg:px-8 bg-gray-50" x-data="{ activeTab: 'all' }">
    <div class="max-w-7xl mx-auto">
      
      <!-- Welcome Header -->
      <div class="bg-white rounded-3xl shadow-sm p-8 mb-8 border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
          <div class="flex items-center gap-4">
               <div class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold">
                  {{ substr(Auth::user()->name, 0, 1) }}
               </div>
               <div>
                  <h1 class="text-3xl font-black text-gray-900">Hello, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                  <p class="text-gray-500 font-medium">Manage your bookings and account settings.</p>
               </div>
          </div>
           <div class="flex gap-3">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-6 py-3 bg-red-50 text-red-600 font-bold rounded-2xl hover:bg-red-100 transition flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
             </form>
            <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> New Trip
            </a>
          </div>
      </div>

      <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Sidebar Navigation -->
        <div class="lg:w-1/4">
             <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden sticky top-28">
                <nav class="flex flex-col p-4 space-y-2">
                    <button @click="activeTab = 'all'" 
                        :class="activeTab === 'all' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600'"
                        class="flex items-center gap-3 px-5 py-4 rounded-xl font-bold transition-all duration-300 w-full text-left">
                        <i class="fa-solid fa-layer-group w-6 text-center"></i> All Bookings
                    </button>

                    <button @click="activeTab = 'packages'" 
                        :class="activeTab === 'packages' ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/30' : 'text-gray-600 hover:bg-gray-50 hover:text-sky-600'"
                         class="flex items-center gap-3 px-5 py-4 rounded-xl font-bold transition-all duration-300 w-full text-left">
                        <i class="fa-solid fa-umbrella-beach w-6 text-center"></i> Holiday Packages
                        @if($bookings->count() > 0) <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-md text-xs">{{ $bookings->count() }}</span> @endif
                    </button>

                     <button @click="activeTab = 'transfers'" 
                        :class="activeTab === 'transfers' ? 'bg-indigo-500 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600'"
                         class="flex items-center gap-3 px-5 py-4 rounded-xl font-bold transition-all duration-300 w-full text-left">
                        <i class="fa-solid fa-car w-6 text-center"></i> Transfers
                        @if($transferBookings->count() > 0) <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-md text-xs">{{ $transferBookings->count() }}</span> @endif
                    </button>

                     <button @click="activeTab = 'flights'" 
                         :class="activeTab === 'flights' ? 'bg-purple-500 text-white shadow-lg shadow-purple-500/30' : 'text-gray-600 hover:bg-gray-50 hover:text-purple-600'"
                         class="flex items-center gap-3 px-5 py-4 rounded-xl font-bold transition-all duration-300 w-full text-left">
                        <i class="fa-solid fa-plane w-6 text-center"></i> Flights
                         @if($flightBookings->count() > 0) <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-md text-xs">{{ $flightBookings->count() }}</span> @endif
                    </button>

                     <button @click="activeTab = 'visas'" 
                         :class="activeTab === 'visas' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600'"
                         class="flex items-center gap-3 px-5 py-4 rounded-xl font-bold transition-all duration-300 w-full text-left">
                        <i class="fa-solid fa-passport w-6 text-center"></i> Visas
                         @if($visaApplications->count() > 0) <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-md text-xs">{{ $visaApplications->count() }}</span> @endif
                    </button>
                    
                    <div class="h-px bg-gray-100 my-2"></div>

                    <a href="{{ route('profile.edit') }}" 
                        class="flex items-center gap-3 px-5 py-4 rounded-xl font-bold text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-300 w-full text-left">
                        <i class="fa-solid fa-user-gear w-6 text-center"></i> Settings
                    </a>
                </nav>
             </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:w-3/4">
             
             <!-- All Bookings Tab -->
             <div x-show="activeTab === 'all'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translateY(10px)" x-transition:enter-end="opacity-100 translateY(0)">
                 <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
                     <i class="fa-solid fa-clock-rotate-left text-blue-600"></i> Recent Activity
                 </h2>
                 <div class="space-y-6">
                    @include('dashboard.partials.packages-list', ['limit' => 3])
                    @include('dashboard.partials.transfers-list', ['limit' => 3])
                    @include('dashboard.partials.flights-list', ['limit' => 3])
                    @include('dashboard.partials.visas-list', ['limit' => 3])
                    
                    @if($bookings->isEmpty() && $transferBookings->isEmpty() && $flightBookings->isEmpty() && $visaApplications->isEmpty())
                        <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300 text-4xl">
                                <i class="fa-solid fa-suitcase-rolling"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No bookings yet</h3>
                            <p class="text-gray-500 mb-8">Start your next adventure with us!</p>
                            <a href="{{ route('home') }}" class="text-blue-600 font-bold hover:underline">Explore Packages</a>
                        </div>
                    @endif
                 </div>
             </div>

             <!-- Packages Tab -->
             <div x-show="activeTab === 'packages'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translateY(10px)" x-transition:enter-end="opacity-100 translateY(0)">
                 <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center text-sm"><i class="fa-solid fa-umbrella-beach"></i></span>
                    My Holiday Packages
                 </h2>
                 <div class="space-y-6">
                     @include('dashboard.partials.packages-list')
                     @if($bookings->isEmpty())
                        <div class="text-center py-12 bg-white rounded-3xl border border-gray-100">
                            <p class="text-gray-500 font-bold">No holiday packages booked yet.</p>
                        </div>
                     @endif
                 </div>
             </div>

             <!-- Transfers Tab -->
             <div x-show="activeTab === 'transfers'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translateY(10px)" x-transition:enter-end="opacity-100 translateY(0)">
                 <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm"><i class="fa-solid fa-car"></i></span>
                    My Transfers
                 </h2>
                 <div class="space-y-6">
                     @include('dashboard.partials.transfers-list')
                      @if($transferBookings->isEmpty())
                        <div class="text-center py-12 bg-white rounded-3xl border border-gray-100">
                            <p class="text-gray-500 font-bold">No transfers booked yet.</p>
                        </div>
                     @endif
                 </div>
             </div>

            <!-- Flights Tab -->
             <div x-show="activeTab === 'flights'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translateY(10px)" x-transition:enter-end="opacity-100 translateY(0)">
                 <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center text-sm"><i class="fa-solid fa-plane"></i></span>
                    My Flights
                 </h2>
                 <div class="space-y-6">
                     @include('dashboard.partials.flights-list')
                      @if($flightBookings->isEmpty())
                        <div class="text-center py-12 bg-white rounded-3xl border border-gray-100">
                            <p class="text-gray-500 font-bold">No flights booked yet.</p>
                        </div>
                     @endif
                 </div>
             </div>

             <!-- Visas Tab -->
             <div x-show="activeTab === 'visas'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translateY(10px)" x-transition:enter-end="opacity-100 translateY(0)">
                 <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm"><i class="fa-solid fa-passport"></i></span>
                    Visa Applications
                 </h2>
                 <div class="space-y-6">
                     @include('dashboard.partials.visas-list')
                      @if($visaApplications->isEmpty())
                        <div class="text-center py-12 bg-white rounded-3xl border border-gray-100">
                            <p class="text-gray-500 font-bold">No visa applications yet.</p>
                        </div>
                     @endif
                 </div>
             </div>
        </div>
      </div>
    </div>
  </div>
@endsection