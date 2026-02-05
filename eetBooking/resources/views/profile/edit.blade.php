@extends('layouts.app')

@section('title', 'Account Settings - Egypt Express Travel')

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8 px-4 sm:px-0">
                <div>
                    <h2 class="font-black text-3xl text-gray-900 leading-tight">
                        {{ __('Account Settings') }}
                    </h2>
                    <p class="text-gray-500 mt-1">Manage your profile information and security.</p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="px-5 py-2.5 bg-white text-gray-700 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection