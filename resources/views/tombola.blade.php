<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gran Tómbola - Soñando y Creciendo en Grande</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .patron-fondo {
            background-color: #000000;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 18h-2v-2h2v2zm-2 2v2h2v-2h-2zm2 2h2v-2h-2v2zm2-2v-2h-2v2h2z' fill='%23111111' fill-opacity='1' fill-rule='evenodd'/%3E%3C/svg%3E");
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Contenedor principal con espacio garantizado abajo para el scroll */
        .contenedor-central {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 1024px;
            margin: 0 auto;
            padding: 2rem 1rem 7rem 1rem;
            text-align: center;
        }

        .titulo-tombola {
            font-size: clamp(3rem, 6vw, 4.5rem);
            font-weight: 900;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
            text-shadow: 0 5px 10px rgba(220, 38, 38, 0.5);
            line-height: 1.1;
        }

        .subtitulo-tombola {
            font-size: clamp(1.25rem, 3vw, 1.875rem);
            font-weight: 700;
            color: #ef4444;
            text-transform: uppercase;
            margin-bottom: 3.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
        }

        /* Animación de carga original en CSS puro (indestructible) */
        .caja-loader {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 2.5rem auto;
        }

        .aro-giratorio {
            width: 120px;
            height: 120px;
            border: 5px solid #1f2937;
            border-top: 5px solid #dc2626;
            border-radius: 50%;
            animation: girar 1s linear infinite;
            margin-bottom: 2rem;
        }

        @keyframes girar {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Tarjeta del ganador con márgenes fijos */
        .tarjeta-ganador {
            display: none;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.96);
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            box-shadow: 0 25px 60px rgba(220, 38, 38, 0.3);
            border-bottom: 12px solid #b91c1c;
            margin-bottom: 3rem;
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .tarjeta-ganador.visible {
            opacity: 1;
            transform: scale(1);
        }

        /* Botón principal con separación garantizada */
        .btn-tombola {
            background-color: #dc2626;
            color: #ffffff;
            font-size: 1.75rem;
            font-weight: 900;
            padding: 1.25rem 3.5rem;
            border-radius: 9999px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 40px rgba(220, 38, 38, 0.8);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            transition: transform 0.2s ease, background-color 0.2s ease;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }

        .btn-tombola:hover {
            background-color: #991b1b;
            transform: scale(1.05);
        }

        .insignia-depto {
            background-color: #f3f4f6;
            color: #374151;
            padding: 0.6rem 1.5rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 1rem;
            border: 1px solid #e5e7eb;
            display: inline-block;
        }

        .insignia-tipo {
            background-color: #dc2626;
            color: #ffffff;
            padding: 0.6rem 1.5rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            display: inline-block;
        }
    </style>
</head>
<body class="font-sans antialiased patron-fondo">

    <!-- Texto Superior Minimalista -->
    <div style="width: 100%; text-align: center; padding-top: 2rem; padding-bottom: 1rem; z-index: 50;">
        <h2 style="color: #d1d5db; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; font-size: 0.95rem;">
            Centro Tecnológico Olof Palme
        </h2>
        <a href="{{ route('dashboard') }}" style="display: inline-block; margin-top: 1rem; color: #9ca3af; font-size: 0.75rem; border: 1px solid #4b5563; border-radius: 9999px; padding: 0.5rem 1.5rem; background: rgba(255,255,255,0.05); text-decoration: none;">
            Volver al Panel
        </a>
    </div>

    <!-- Contenedor Central -->
    <div class="contenedor-central">
        
        <h1 class="titulo-tombola">GRAN TÓMBOLA</h1>
        <p class="subtitulo-tombola">Soñando y Creciendo en Grande - 2027</p>

        <!-- Tarjeta del Ganador -->
        <div id="winner-card" class="tarjeta-ganador">
            <h2 style="font-size: 1.1rem; font-weight: 900; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.25em; margin-bottom: 1.5rem;">
                🏆 ¡Felicidades al Ganador! 🏆
            </h2>
            
            <div id="winner-main-info" style="font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 900; color: #000000; margin-bottom: 2rem; line-height: 1.2;"></div>
            
            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; border-top: 1px solid #e5e7eb; padding-top: 2rem;">
                <span id="winner-depto" class="insignia-depto"></span>
                <span id="winner-tipo" class="insignia-tipo"></span>
            </div>
        </div>

        <!-- Animación de Carga (Idéntica al diseño anterior) -->
        <div id="loading-animation" class="caja-loader">
            <div class="aro-giratorio"></div>
            <p style="color: #ffffff; font-size: 1.5rem; font-weight: 700; letter-spacing: 0.05em;">
                Generando ganador al azar...
            </p>
        </div>

        <!-- Botón de Acción -->
        <button id="spin-btn" class="btn-tombola">
            <span>🎉</span>
            <span id="btn-text">Sacar Ganador</span>
            <span>🎉</span>
        </button>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
        document.getElementById('spin-btn').addEventListener('click', function() {
            const btn = this;
            const btnText = document.getElementById('btn-text');
            const winnerCard = document.getElementById('winner-card');
            const loading = document.getElementById('loading-animation');

            // Ocultar botón y tarjeta, mostrar spinner
            btn.disabled = true;
            btn.style.display = 'none';
            winnerCard.classList.remove('visible');
            winnerCard.style.display = 'none';
            loading.style.display = 'flex';

            fetch('{{ route("tombola.winner") }}')
                .then(response => response.json())
                .then(data => {
                    if(data.error) {
                        Swal.fire({ 
                            icon: 'warning', 
                            title: 'Aviso', 
                            text: data.error, 
                            confirmButtonColor: '#dc2626', 
                            background: '#111111', 
                            color: '#fff' 
                        });
                        loading.style.display = 'none';
                        btn.style.display = 'inline-flex';
                        btn.disabled = false;
                        return;
                    }

                    setTimeout(() => {
                        loading.style.display = 'none';
                        
                        const mainInfoText = `${data.nombre_completo} - ${data.centro_procedencia}`;
                        document.getElementById('winner-main-info').textContent = mainInfoText;
                        document.getElementById('winner-depto').textContent = `📍 ${data.departamento}`;
                        document.getElementById('winner-tipo').textContent = data.tipo_procedencia;

                        winnerCard.style.display = 'block';
                        
                        setTimeout(() => {
                            winnerCard.classList.add('visible');
                            winnerCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            triggerConfetti();
                        }, 50);

                        btn.disabled = false;
                        btnText.textContent = "Sacar Otro Ganador";
                        btn.style.display = 'inline-flex';
                    }, 3000); 
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.style.display = 'none';
                    btn.style.display = 'inline-flex';
                    btn.disabled = false;
                    Swal.fire({ 
                        icon: 'error', 
                        title: 'Error de conexión', 
                        text: 'Hubo un problema al conectar con el servidor.', 
                        confirmButtonColor: '#dc2626' 
                    });
                });
        });

        function triggerConfetti() {
            var duration = 5000;
            var end = Date.now() + duration;

            (function frame() {
                confetti({ 
                    particleCount: 8, 
                    angle: 60, 
                    spread: 65, 
                    origin: { x: 0 }, 
                    colors: ['#dc2626', '#000000', '#ffffff'] 
                });
                confetti({ 
                    particleCount: 8, 
                    angle: 120, 
                    spread: 65, 
                    origin: { x: 1 }, 
                    colors: ['#dc2626', '#000000', '#ffffff'] 
                });
                if (Date.now() < end) requestAnimationFrame(frame);
            }());
        }
    </script>
</body>
</html>