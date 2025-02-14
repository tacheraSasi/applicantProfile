<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tachera SASI application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #0e0e16, #1b1b2b, #2d2d3d);
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
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        #clock {
            font-size: 4.5rem;
            margin-bottom: 5px;
            font-weight: bold;
            transition: transform 0.2s ease;
        }

        #clock:hover {
            transform: scale(1.05);
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }

        #date {
            font-size: 1.5rem;
            margin-bottom: 20px;
            opacity: 0.8;
        }

        #name {
            font-size: 2rem;
            margin-bottom: 25px;
            letter-spacing: 2px;
            font-weight: 700;
            cursor: pointer;
        }

        #name:hover {
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }

        #search {
            width: 80%;
            max-width: 600px;
            height: 55px;
            border: none;
            border-radius: 30px;
            padding: 0 20px;
            font-size: 1.5rem;
            background-color: rgba(43, 43, 60, 0.7);
            color: white;
            outline: none;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            transition: box-shadow 0.3s ease, background-color 0.3s ease;
        }

        #search:focus {
            box-shadow: 0px 4px 20px rgba(255, 255, 255, 0.7);
            background-color: rgba(43, 43, 60, 0.9);
        }

        .favorite-links {
            margin-top: 40px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .favorite-links a {
            font-size: 1.2rem;
            color: white;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .favorite-links a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        #footer {
            position: absolute;
            bottom: 20px;
            font-size: 1.1rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        #footer:hover {
            opacity: 1;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 50px;
        }

        .social-icons a {
            color: white;
            font-size: 2rem;
            transition: transform 0.2s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="particles">
        <canvas id="particle-canvas"></canvas>
    </div>

    <script>
        // Clock update function
        function updateClock() {
            const clockElement = document.getElementById('clock');
            const dateElement = document.getElementById('date');
            const now = new Date();

            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            dateElement.textContent = now.toLocaleDateString(undefined, options);
        }

        function searchGoogle(event) {
            if (event.key === 'Enter') {
                const query = document.getElementById('search').value;
                window.open(`https://www.google.com/search?q=${encodeURIComponent(query)}`, '_blank');
                query = ""
            }
        }


        setInterval(updateClock, 1000);
        updateClock();

        // Particle effect
        function particleEffect() {
            const canvas = document.getElementById('particle-canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const particlesArray = [];

            const createParticle = () => {
                particlesArray.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 3 + 1,
                    speedX: (Math.random() * 2) - 1,
                    speedY: (Math.random() * 2) - 1
                });
            };

            const drawParticle = (particle) => {
                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                ctx.closePath();
                ctx.fill();
            };

            const updateParticle = (particle) => {
                particle.x += particle.speedX;
                particle.y += particle.speedY;
                if (particle.size > 0.2) particle.size -= 0.01;

                if (particle.x < 0 || particle.x > canvas.width || particle.y < 0 || particle.y > canvas.height) {
                    particle.x = Math.random() * canvas.width;
                    particle.y = Math.random() * canvas.height;
                    particle.size = Math.random() * 3 + 1;
                }
            };

            const animateParticles = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particlesArray.forEach((particle, index) => {
                    updateParticle(particle);
                    drawParticle(particle);
                });
                requestAnimationFrame(animateParticles);
            };

            for (let i = 0; i < 100; i++) {
                createParticle();
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
