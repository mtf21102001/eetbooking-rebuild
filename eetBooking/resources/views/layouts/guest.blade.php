<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EET Booking') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        .auth-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
            z-index: -1;
            overflow: hidden;
        }

        .auth-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 20% 30%, rgba(168, 85, 247, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(45, 212, 191, 0.1) 0%, transparent 40%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border-radius: 24px;
        }

        .auth-input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
        }

        .auth-input:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2) !important;
        }

        .premium-btn {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.5);
            filter: brightness(1.1);
        }

        .text-soft {
            color: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>

<body class="antialiased">
    <div class="auth-bg"></div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8 transform hover:scale-105 transition-transform duration-300">
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-white drop-shadow-2xl" />
            </a>
        </div>

        <div class="w-full sm:max-w-md glass-card p-8 mx-4">
            {{ $slot }}
        </div>

        <div class="mt-8 text-soft text-sm">
            &copy; {{ date('Y') }} EET Booking. All rights reserved.
        </div>
    </div>
</body>

</html>