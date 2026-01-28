<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undercover - Minigames</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
            background: #0a0e27;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                linear-gradient(180deg, rgba(10, 14, 39, 0.4) 0%, rgba(10, 14, 39, 0.8) 100%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><rect fill="%230a0e27"/><g opacity="0.3"><rect x="100" y="50" width="80" height="200" fill="%231a2456"/><rect x="300" y="100" width="60" height="300" fill="%23152040"/><rect x="500" y="80" width="100" height="250" fill="%231a2456"/><rect x="800" y="120" width="70" height="180" fill="%23152040"/><rect x="1000" y="60" width="90" height="280" fill="%231a2456"/><rect x="1200" y="90" width="75" height="220" fill="%23152040"/><rect x="1400" y="110" width="85" height="260" fill="%231a2456"/><rect x="1600" y="70" width="95" height="240" fill="%23152040"/></g></svg>');
            background-size: cover;
            background-position: center;
            z-index: 0;
        }

        /* Rain Effect */
        body::after {
            content: '';
            position: absolute;
            top: -100%;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                linear-gradient(transparent 0%, transparent 50%, rgba(255,255,255,0.03) 50%, rgba(255,255,255,0.03) 100%);
            background-size: 2px 20px;
            animation: rain 0.3s linear infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes rain {
            0% { transform: translateY(0); }
            100% { transform: translateY(20px); }
        }

        .container {
            background: rgba(15, 20, 45, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 60px 50px;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 0 50px rgba(138, 100, 255, 0.05);
            text-align: center;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(138, 100, 255, 0.2);
        }

        /* Spy Icon */
        .spy-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            position: relative;
        }

        .spy-icon svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 4px 15px rgba(255, 255, 255, 0.3));
        }

        h1 {
            font-size: 2.8rem;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 4px;
            text-shadow:
                0 0 20px rgba(138, 100, 255, 0.5),
                0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .subtitle {
            font-size: 1.1rem;
            color: #b8b8d1;
            margin-bottom: 50px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .option-btn {
            background: linear-gradient(135deg, #8a64ff 0%, #6b46d6 100%);
            color: white;
            border: none;
            padding: 20px 40px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow:
                0 4px 15px rgba(138, 100, 255, 0.4),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .option-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .option-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow:
                0 6px 25px rgba(138, 100, 255, 0.6),
                inset 0 0 30px rgba(255, 255, 255, 0.15);
        }

        .option-btn:active {
            transform: translateY(-1px);
        }

        .option-btn span {
            position: relative;
            z-index: 1;
        }

        /* Glow effect on hover */
        .container:hover {
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 0 60px rgba(138, 100, 255, 0.1),
                0 0 30px rgba(138, 100, 255, 0.3);
        }

        /* Tablet Styles */
        @media (min-width: 768px) and (max-width: 1024px) {
            .container {
                max-width: 500px;
                padding: 70px 55px;
            }

            .spy-icon {
                width: 130px;
                height: 130px;
                margin-bottom: 30px;
            }

            h1 {
                font-size: 3.2rem;
                letter-spacing: 5px;
                margin-bottom: 18px;
            }

            .subtitle {
                font-size: 1.2rem;
                margin-bottom: 55px;
            }

            .option-btn {
                padding: 22px 50px;
                font-size: 1.3rem;
                letter-spacing: 2.5px;
            }

            .options {
                gap: 22px;
            }
        }

        /* Desktop Styles */
        @media (min-width: 1025px) {
            body {
                padding: 40px;
            }

            .container {
                max-width: 550px;
                padding: 70px 60px 80px;
            }

            .spy-icon {
                width: 140px;
                height: 140px;
                margin-bottom: 30px;
            }

            h1 {
                font-size: 3.5rem;
                letter-spacing: 6px;
                margin-bottom: 18px;
            }

            .subtitle {
                font-size: 1.15rem;
                margin-bottom: 55px;
                letter-spacing: 1.5px;
            }

            .option-btn {
                padding: 22px 80px;
                font-size: 1.25rem;
                letter-spacing: 2.5px;
            }

            .options {
                gap: 22px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1440px) {
            .container {
                max-width: 600px;
                padding: 80px 70px 90px;
            }

            .spy-icon {
                width: 160px;
                height: 160px;
                margin-bottom: 35px;
            }

            h1 {
                font-size: 3.8rem;
                letter-spacing: 7px;
                margin-bottom: 20px;
            }

            .subtitle {
                font-size: 1.25rem;
                margin-bottom: 60px;
            }

            .option-btn {
                padding: 24px 90px;
                font-size: 1.3rem;
            }
        }

        /* Mobile Styles */
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
                letter-spacing: 2px;
            }

            .container {
                padding: 40px 30px;
            }

            .spy-icon {
                width: 100px;
                height: 100px;
            }

            .option-btn {
                font-size: 1rem;
                padding: 18px 35px;
                letter-spacing: 1.5px;
            }

            .subtitle {
                font-size: 1rem;
                margin-bottom: 40px;
            }
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .spy-icon {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="spy-icon">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Hat -->
                <ellipse cx="100" cy="45" rx="70" ry="12" fill="#ffffff"/>
                <rect x="60" y="45" width="80" height="25" rx="5" fill="#ffffff"/>

                <!-- Sunglasses -->
                <rect x="50" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                <rect x="105" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                <rect x="95" y="92" width="10" height="8" fill="#ffffff"/>

                <!-- Face outline -->
                <circle cx="100" cy="100" r="55" fill="#ffffff" opacity="0.1"/>

                <!-- Collar/Tie -->
                <path d="M85 130 L100 160 L115 130 Z" fill="#ffffff"/>
                <rect x="75" y="130" width="50" height="15" fill="#ffffff"/>

                <!-- Coat -->
                <path d="M60 145 L60 180 L85 175 L85 145 Z" fill="#ffffff"/>
                <path d="M140 145 L140 180 L115 175 L115 145 Z" fill="#ffffff"/>
            </svg>
        </div>

        <h1>UNDERCOVER</h1>
        <p class="subtitle">Pilih Mode Permainan</p>

        <div class="options">
            <button class="option-btn" onclick="location.href='/undercover/offline'">
                <span>Mode Offline</span>
            </button>
            <button class="option-btn" onclick="location.href='/undercover/online'">
                <span>Mode Online</span>
            </button>
        </div>
    </div>
</body>
</html>
