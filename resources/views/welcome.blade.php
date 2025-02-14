<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tachera SASI Application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #0e0e16, #1a1a20, #32323a);
            background-size: 400% 400%;
            animation: gradient 10s ease infinite;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }
    </style>
</head>

<body>
    <div class="flex flex-col items-center justify-center h-screen fade-in">
        <h1 class="text-5xl font-bold mb-6">Welcome to Tachera SASI Application</h1>
        <p class="text-lg opacity-80">A simple Laravel demo application showcasing my skills.</p>
        <p class="mt-2 opacity-70">Use <b>demo@gmail.com</b> and <b>password: demo</b> to log in.</p>
        <a href="{{ route('dashboard') }}" class="mt-6 px-6 py-3 bg-blue-500 text-white text-lg font-medium rounded-lg shadow-lg hover:bg-blue-600 transition">Get Started</a>
    </div>

    <canvas id="particle-canvas"></canvas>

    <script>
        function particleEffect() {
            const canvas = document.getElementById('particle-canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const particles = [];
            for (let i = 0; i < 100; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 3 + 1,
                    speedX: (Math.random() * 2) - 1,
                    speedY: (Math.random() * 2) - 1
                });
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => {
                    p.x += p.speedX;
                    p.y += p.speedY;
                    if (p.size > 0.2) p.size -= 0.01;
                    if (p.x < 0 || p.x > canvas.width || p.y < 0 || p.y > canvas.height) {
                        p.x = Math.random() * canvas.width;
                        p.y = Math.random() * canvas.height;
                        p.size = Math.random() * 3 + 1;
                    }
                    ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                    ctx.fill();
                });
                requestAnimationFrame(animateParticles);
            }
            animateParticles();
        }

        window.addEventListener('resize', () => {
            const canvas = document.getElementById('particle-canvas');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
        particleEffect();
    </script>
</body>

</html>
