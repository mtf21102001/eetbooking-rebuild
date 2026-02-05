<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page Not Found | Egypt Express Travel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=outfit:400,600,800,900&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    @keyframes floating {

      0%,
      100% {
        transform: translateY(0) rotateX(0) rotateY(0);
      }

      50% {
        transform: translateY(-20px) rotateX(2deg) rotateY(-2deg);
      }
    }

    @keyframes glow {

      0%,
      100% {
        opacity: 0.3;
        transform: scale(1);
      }

      50% {
        opacity: 0.6;
        transform: scale(1.2);
      }
    }

    body {
      background-color: #050810;
      font-family: 'Outfit', sans-serif;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      perspective: 2000px;
    }

    /* Ambient Light */
    .ambient-glow {
      position: absolute;
      width: 800px;
      height: 800px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
      z-index: 0;
      animation: glow 8s ease-in-out infinite;
      filter: blur(100px);
    }

    .premium-card {
      background: white;
      border-radius: 50px;
      box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.5);
      position: relative;
      overflow: hidden;
      z-index: 10;
      animation: floating 6s ease-in-out infinite;
      transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }

    /* The trick: The animation is inside a white container on the white card */
    #lottie-container {
      width: 100%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-primary {
      background: #0f172a;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #1e293b;
      transform: scale(1.05);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-outline {
      background: white;
      color: #475569;
      border: 2px solid #f1f5f9;
      transition: all 0.3s ease;
    }

    .btn-outline:hover {
      background: #f8fafc;
      border-color: #e2e8f0;
      transform: scale(1.05);
    }

    .text-404 {
      font-size: 10rem;
      line-height: 1;
      font-weight: 900;
      background: linear-gradient(180deg, #0f172a 0%, rgba(15, 23, 42, 0.3) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: -1rem;
    }
  </style>
</head>

<body class="antialiased">
  <div class="ambient-glow"></div>

  <div class="max-w-4xl w-full px-6">
    <div class="premium-card p-12 md:p-20 flex flex-col md:flex-row items-center gap-12">

      <!-- Left Side: Caveman -->
      <div class="w-full md:w-1/2">
        <div id="lottie-container" class="h-[300px] md:h-[400px]">
          <!-- Lottie here -->
        </div>
      </div>

      <!-- Right Side: Content -->
      <div class="w-full md:w-1/2 text-center md:text-left">
        <div class="text-404 opacity-80">404</div>

        <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">
          Wrong <span class="text-indigo-600">Era</span>, <br>Friend?
        </h2>

        <p class="text-slate-500 text-lg md:text-xl font-medium mb-12">
          Our buddy here hasn't seen this page in thousands of years. It's time to head back!
        </p>

        <div class="flex flex-col sm:flex-row items-center gap-4">
          <a href="/" class="btn-primary w-full sm:w-auto px-10 py-5 rounded-3xl font-black text-center text-lg">
            Home
          </a>
          <button onclick="window.history.back()"
            class="btn-outline w-full sm:w-auto px-10 py-5 rounded-3xl font-black text-center text-lg">
            Back
          </button>
        </div>
      </div>
    </div>

    <!-- System Status Footer -->
    <div
      class="mt-12 flex justify-center items-center gap-6 text-slate-500 font-bold text-xs uppercase tracking-[0.3em] text-white">
      <span>Egypt Express Travel</span>
      <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
      <span>Error Protocol 404</span>
    </div>
  </div>

  <!-- Lottie Implementation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const container = document.getElementById('lottie-container');
      const anim = lottie.loadAnimation({
        container: container,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '{{ asset("animations/404.json") }}'
      });

      // Interactive Parallax
      const card = document.querySelector('.premium-card');
      document.addEventListener('mousemove', (e) => {
        const x = (window.innerWidth / 2 - e.pageX) / 50;
        const y = (window.innerHeight / 2 - e.pageY) / 50;
        card.style.transform = `rotateY(${x}deg) rotateX(${-y}deg) translateY(${y * 2}px)`;
      });

      // Final Redirect: 7 seconds to Home
      setTimeout(() => {
        window.location.href = '/';
      }, 10000);
    });
  </script>
</body>

</html>