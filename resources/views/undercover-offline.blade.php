<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undercover - Mode Offline</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        html::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px 15px;
            position: relative;
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
            padding: 30px 25px;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 0 50px rgba(138, 100, 255, 0.05);
            text-align: center;
            max-width: 450px;
            width: 100%;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(138, 100, 255, 0.2);
        }

        h1 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 8px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 4px;
            text-shadow:
                0 0 20px rgba(138, 100, 255, 0.5),
                0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .player-label {
            font-size: 1rem;
            color: #b8b8d1;
            margin-bottom: 12px;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .player-total-box {
            background: rgba(138, 100, 255, 0.15);
            border: 2px solid rgba(138, 100, 255, 0.4);
            border-radius: 15px;
            padding: 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .player-total-label {
            font-size: 1.1rem;
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .player-total-counter {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .roles-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .role-item {
            background: rgba(20, 25, 50, 0.6);
            border: 1px solid rgba(138, 100, 255, 0.3);
            border-radius: 15px;
            padding: 14px 18px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 14px;
            transition: all 0.3s ease;
        }

        .role-item:hover {
            background: rgba(30, 35, 60, 0.7);
            border-color: rgba(138, 100, 255, 0.5);
            box-shadow: 0 4px 20px rgba(138, 100, 255, 0.2);
        }

        .role-item.role-civilian {
            border-color: rgba(100, 180, 255, 0.35);
        }

        .role-item.role-civilian:hover {
            border-color: rgba(100, 180, 255, 0.6);
            box-shadow: 0 4px 20px rgba(100, 180, 255, 0.15);
        }

        .role-item.role-spy {
            border-color: rgba(255, 100, 100, 0.35);
        }

        .role-item.role-spy:hover {
            border-color: rgba(255, 100, 100, 0.6);
            box-shadow: 0 4px 20px rgba(255, 100, 100, 0.15);
        }

        .role-item.role-mrwhite {
            border-color: rgba(200, 200, 220, 0.35);
        }

        .role-item.role-mrwhite:hover {
            border-color: rgba(200, 200, 220, 0.6);
            box-shadow: 0 4px 20px rgba(200, 200, 220, 0.15);
        }

        .role-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
        }

        .role-icon svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 2px 8px rgba(255, 255, 255, 0.2));
        }

        .role-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }

        .role-name {
            font-size: 0.95rem;
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .role-counter {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .counter-btn {
            width: 35px;
            height: 35px;
            background: rgba(138, 100, 255, 0.2);
            border: 1px solid rgba(138, 100, 255, 0.4);
            border-radius: 8px;
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .counter-btn:hover {
            background: rgba(138, 100, 255, 0.4);
            border-color: rgba(138, 100, 255, 0.6);
        }

        .counter-btn:active {
            background: rgba(138, 100, 255, 0.55);
        }

        .counter-value {
            font-size: 1.5rem;
            color: #ffffff;
            font-weight: 700;
            min-width: 30px;
            text-align: center;
        }

        .start-btn {
            background: linear-gradient(135deg, #8a64ff 0%, #6b46d6 100%);
            color: white;
            border: none;
            padding: 16px 60px;
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
            width: 100%;
        }

        .start-btn::before {
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

        .start-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .start-btn:hover {
            box-shadow:
                0 6px 25px rgba(138, 100, 255, 0.6),
                inset 0 0 30px rgba(255, 255, 255, 0.15);
        }

        .start-btn span {
            position: relative;
            z-index: 1;
        }

        .back-btn {
            background: transparent;
            color: #b8b8d1;
            border: 1px solid rgba(184, 184, 209, 0.3);
            padding: 12px 30px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 12px;
            width: 100%;
        }

        .word-btn {
            background: rgba(138, 100, 255, 0.14);
            color: #ffffff;
            border: 1px solid rgba(138, 100, 255, 0.35);
            padding: 12px 30px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 12px;
            width: 100%;
        }

        .word-btn:hover {
            background: rgba(138, 100, 255, 0.24);
            border-color: rgba(138, 100, 255, 0.55);
        }

        .back-btn:hover {
            background: rgba(184, 184, 209, 0.1);
            border-color: rgba(184, 184, 209, 0.5);
            color: #ffffff;
        }

        .floating-word-btn {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 5;
            padding: 14px 18px;
            border-radius: 999px;
            border: 1px solid rgba(138, 100, 255, 0.45);
            background: linear-gradient(135deg, rgba(138, 100, 255, 0.95) 0%, rgba(107, 70, 214, 0.95) 100%);
            color: #ffffff;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 800;
            letter-spacing: 1px;
            box-shadow: 0 8px 24px rgba(138, 100, 255, 0.35);
            animation: floatAction 3.5s ease-in-out infinite;
        }

        .floating-word-btn:hover {
            box-shadow: 0 10px 28px rgba(138, 100, 255, 0.5);
        }

        @keyframes floatAction {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        /* Notification Modal */
        .notification-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.2s ease;
        }

        .notification-overlay.show {
            display: flex;
        }

        .notification-modal {
            background: rgba(15, 20, 45, 0.95);
            border: 2px solid rgba(138, 100, 255, 0.5);
            border-radius: 20px;
            padding: 30px 35px;
            max-width: 400px;
            width: 90%;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.8),
                inset 0 0 30px rgba(138, 100, 255, 0.1);
            animation: slideIn 0.3s ease;
            text-align: center;
        }

        .notification-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: rgba(138, 100, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .notification-message {
            color: #ffffff;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .notification-btn {
            background: linear-gradient(135deg, #8a64ff 0%, #6b46d6 100%);
            color: white;
            border: none;
            padding: 12px 40px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 4px 15px rgba(138, 100, 255, 0.4);
        }

        .notification-btn:hover {
            box-shadow: 0 6px 20px rgba(138, 100, 255, 0.6);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Very Small Mobile Styles */
        @media (max-width: 360px) {
            body {
                padding: 10px 8px;
            }

            .container {
                padding: 20px 15px;
                border-radius: 15px;
            }

            h1 {
                font-size: 1.6rem;
                letter-spacing: 2px;
                margin-bottom: 6px;
            }

            .player-label {
                font-size: 0.85rem;
                margin-bottom: 10px;
            }

            .player-total-box {
                padding: 12px;
                gap: 10px;
                flex-direction: column;
            }

            .player-total-label {
                font-size: 0.9rem;
            }

            .player-total-counter {
                gap: 15px;
            }

            .roles-container {
                gap: 10px;
            }

            .role-item {
                padding: 12px 14px;
                gap: 10px;
            }

            .role-icon {
                width: 38px;
                height: 38px;
            }

            .role-name {
                font-size: 0.82rem;
            }

            .counter-btn {
                width: 28px;
                height: 28px;
                font-size: 1rem;
            }

            .counter-value {
                font-size: 1.1rem;
                min-width: 22px;
            }

            .start-btn {
                padding: 14px 40px;
                font-size: 1rem;
                letter-spacing: 1.5px;
            }

            .back-btn {
                padding: 10px 25px;
                font-size: 0.85rem;
                margin-top: 10px;
            }

            .notification-modal {
                padding: 25px 20px;
                width: 95%;
            }

            .notification-icon {
                width: 50px;
                height: 50px;
                margin-bottom: 15px;
                font-size: 1.6rem;
            }

            .notification-message {
                font-size: 0.95rem;
                margin-bottom: 20px;
            }

            .notification-btn {
                padding: 10px 35px;
                font-size: 0.9rem;
            }
        }

        /* Small Mobile Styles */
        @media (min-width: 361px) and (max-width: 480px) {
            body {
                padding: 15px 10px;
            }

            .container {
                padding: 22px 18px;
            }

            h1 {
                font-size: 1.8rem;
                letter-spacing: 2.5px;
            }

            .player-label {
                font-size: 0.9rem;
                margin-bottom: 10px;
            }

            .player-total-box {
                padding: 15px;
                gap: 12px;
            }

            .player-total-label {
                font-size: 0.95rem;
            }

            .role-item {
                padding: 12px 16px;
                gap: 12px;
            }

            .role-icon {
                width: 42px;
                height: 42px;
            }

            .role-name {
                font-size: 0.88rem;
            }

            .counter-btn {
                width: 30px;
                height: 30px;
                font-size: 1.1rem;
            }

            .counter-value {
                font-size: 1.2rem;
            }

            .start-btn {
                padding: 15px 45px;
                font-size: 1.05rem;
            }

            .back-btn {
                padding: 11px 28px;
                font-size: 0.9rem;
            }
        }

        /* Medium Mobile / Phablet */
        @media (min-width: 481px) and (max-width: 600px) {
            .container {
                padding: 25px 20px;
            }

            h1 {
                font-size: 2rem;
                letter-spacing: 3px;
            }

            .player-total-box {
                padding: 18px;
                gap: 15px;
            }

            .player-total-label {
                font-size: 1rem;
            }

            .role-item {
                padding: 14px 18px;
                gap: 14px;
            }

            .role-icon {
                width: 48px;
                height: 48px;
            }

            .role-name {
                font-size: 0.95rem;
            }

            .counter-btn {
                width: 34px;
                height: 34px;
                font-size: 1.25rem;
            }

            .counter-value {
                font-size: 1.4rem;
                min-width: 28px;
            }

            .start-btn {
                padding: 16px 50px;
                font-size: 1.1rem;
            }
        }

        /* Tablet Portrait */
        @media (min-width: 601px) and (max-width: 767px) {
            .container {
                max-width: 550px;
                padding: 35px 30px;
            }

            h1 {
                font-size: 2.3rem;
                letter-spacing: 4px;
            }

            .player-label {
                font-size: 1.05rem;
                margin-bottom: 15px;
            }

            .player-total-box {
                padding: 20px;
            }

            .player-total-label {
                font-size: 1.1rem;
            }

            .roles-container {
                gap: 15px;
            }

            .role-item {
                padding: 16px 20px;
                gap: 15px;
            }

            .role-icon {
                width: 52px;
                height: 52px;
            }

            .counter-btn {
                width: 36px;
                height: 36px;
                font-size: 1.3rem;
            }

            .counter-value {
                font-size: 1.5rem;
                min-width: 30px;
            }

            .start-btn {
                padding: 18px 60px;
                font-size: 1.15rem;
            }
        }

        /* Tablet Landscape & Desktop */
        @media (min-width: 768px) {
            .container {
                max-width: 800px;
                padding: 50px 45px;
            }

            h1 {
                font-size: 3rem;
                letter-spacing: 5px;
                margin-bottom: 12px;
            }

            .player-label {
                font-size: 1.1rem;
                margin-bottom: 18px;
            }

            .player-total-box {
                padding: 25px;
            }

            .player-total-label {
                font-size: 1.2rem;
            }

            .roles-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .role-item {
                flex-direction: column;
                align-items: center;
                padding: 25px 20px;
                gap: 12px;
            }

            .role-info {
                align-items: center;
            }

            .role-icon {
                width: 65px;
                height: 65px;
            }

            .role-name {
                font-size: 1rem;
            }

            .counter-btn {
                width: 40px;
                height: 40px;
                font-size: 1.4rem;
            }

            .counter-value {
                font-size: 1.6rem;
                min-width: 35px;
            }

            .start-btn {
                padding: 20px 70px;
                font-size: 1.3rem;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .container {
                max-width: 900px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>UNDERCOVER</h1>
        <p class="player-label">Jumlah pemain</p>

        <div class="player-total-box">
            <span class="player-total-label">Total Pemain:</span>
            <div class="player-total-counter">
                <button class="counter-btn" onclick="decreaseTotalPlayers()">−</button>
                <span class="counter-value" id="total-players">3</span>
                <button class="counter-btn" onclick="increaseTotalPlayers()">+</button>
            </div>
        </div>

        <div class="roles-container">
            <!-- Civilian Role -->
            <div class="role-item role-civilian">
                <div class="role-icon">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="60" r="30" fill="#64b4ff"/>
                        <circle cx="88" cy="55" r="4" fill="#1a1a2e"/>
                        <circle cx="112" cy="55" r="4" fill="#1a1a2e"/>
                        <path d="M92 68 Q100 76 108 68" stroke="#1a1a2e" stroke-width="3" fill="none" stroke-linecap="round"/>
                        <path d="M60 150 Q60 100 100 95 Q140 100 140 150" fill="#64b4ff"/>
                        <circle cx="100" cy="100" r="65" stroke="#64b4ff" stroke-width="2" fill="none" opacity="0.2"/>
                    </svg>
                </div>
                <div class="role-info">
                    <div class="role-name">Civilian (Warga)</div>
                    <div class="role-counter">
                        <button class="counter-btn" onclick="decreaseRole('civilian')">−</button>
                        <span class="counter-value" id="civilian-count">2</span>
                        <button class="counter-btn" onclick="increaseRole('civilian')">+</button>
                    </div>
                </div>
            </div>

            <!-- Spy Role -->
            <div class="role-item role-spy">
                <div class="role-icon">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="60" r="30" fill="#ff6464"/>
                        <rect x="65" y="50" width="70" height="16" rx="8" fill="#1a1a2e" opacity="0.85"/>
                        <circle cx="88" cy="58" r="3" fill="#ff6464"/>
                        <circle cx="112" cy="58" r="3" fill="#ff6464"/>
                        <path d="M95 72 L100 70 L105 72" stroke="#1a1a2e" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M60 150 Q60 100 100 95 Q140 100 140 150" fill="#ff6464"/>
                        <path d="M90 120 L100 145 L110 120" fill="#1a1a2e" opacity="0.6"/>
                        <circle cx="100" cy="100" r="65" stroke="#ff6464" stroke-width="2" fill="none" opacity="0.2"/>
                    </svg>
                </div>
                <div class="role-info">
                    <div class="role-name">Spy (Penyusup)</div>
                    <div class="role-counter">
                        <button class="counter-btn" onclick="decreaseRole('spy')">−</button>
                        <span class="counter-value" id="spy-count">1</span>
                        <button class="counter-btn" onclick="increaseRole('spy')">+</button>
                    </div>
                </div>
            </div>

            <!-- Mr. White Role -->
            <div class="role-item role-mrwhite">
                <div class="role-icon">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="60" r="30" fill="#e0e0ee"/>
                        <circle cx="88" cy="55" r="4" fill="#1a1a2e"/>
                        <circle cx="112" cy="55" r="4" fill="#1a1a2e"/>
                        <path d="M90 70 L110 70" stroke="#1a1a2e" stroke-width="2.5" stroke-linecap="round"/>
                        <text x="100" y="48" text-anchor="middle" font-size="18" font-weight="bold" fill="#1a1a2e">?</text>
                        <path d="M60 150 Q60 100 100 95 Q140 100 140 150" fill="#e0e0ee"/>
                        <circle cx="100" cy="100" r="65" stroke="#e0e0ee" stroke-width="2" fill="none" opacity="0.2"/>
                    </svg>
                </div>
                <div class="role-info">
                    <div class="role-name">Mr. White</div>
                    <div class="role-counter">
                        <button class="counter-btn" onclick="decreaseRole('mrwhite')">−</button>
                        <span class="counter-value" id="mrwhite-count">0</span>
                        <button class="counter-btn" onclick="increaseRole('mrwhite')">+</button>
                    </div>
                </div>
            </div>
        </div>

        <button class="start-btn" onclick="startGame()">
            <span>Mulai Permainan</span>
        </button>

        <button class="back-btn" onclick="location.href='/'">
            Kembali
        </button>
    </div>

    <a href="/undercover/words" class="floating-word-btn">Tambah Kata</a>

    <!-- Notification Modal -->
    <div class="notification-overlay" id="notificationOverlay" onclick="closeNotification()">
        <div class="notification-modal" onclick="event.stopPropagation()">
            <div class="notification-icon">⚠️</div>
            <div class="notification-message" id="notificationMessage"></div>
            <button class="notification-btn" onclick="closeNotification()">OK</button>
        </div>
    </div>

    <script>
        function showNotification(message) {
            document.getElementById('notificationMessage').textContent = message;
            document.getElementById('notificationOverlay').classList.add('show');
        }

        function closeNotification() {
            document.getElementById('notificationOverlay').classList.remove('show');
        }

        function getTotalPlayers() {
            return parseInt(document.getElementById('total-players').textContent);
        }

        function getMaxSpy() {
            const total = getTotalPlayers();
            // Jika total pemain = 3 atau 4, max spy = 1
            // Jika total pemain = 5, max spy = 2
            // Jika total pemain > 5, max spy = floor(total / 2.5)
            if (total <= 4) {
                return 1;
            } else if (total === 5) {
                return 2;
            }
            return Math.floor(total / 2.5);
        }

        function getMaxMrWhite() {
            const total = getTotalPlayers();
            // Logika sama seperti spy
            if (total <= 4) {
                return 1;
            } else if (total === 5) {
                return 2;
            }
            return Math.floor(total / 2.5);
        }

        function updateCivilian() {
            const total = getTotalPlayers();
            const spy = parseInt(document.getElementById('spy-count').textContent);
            const mrwhite = parseInt(document.getElementById('mrwhite-count').textContent);
            const newCivilian = total - spy - mrwhite;
            document.getElementById('civilian-count').textContent = Math.max(0, newCivilian);
        }

        function increaseTotalPlayers() {
            const totalElement = document.getElementById('total-players');
            let total = getTotalPlayers();
            totalElement.textContent = total + 1;
            updateCivilian();
        }

        function decreaseTotalPlayers() {
            const totalElement = document.getElementById('total-players');
            let total = getTotalPlayers();
            const spy = parseInt(document.getElementById('spy-count').textContent);
            const mrwhite = parseInt(document.getElementById('mrwhite-count').textContent);
            const minTotal = spy + mrwhite + 1; // Minimal harus ada 1 civilian

            if (total > 3 && total > minTotal) {
                totalElement.textContent = total - 1;
                updateCivilian();

                // Cek jika spy melebihi max setelah total berkurang
                const maxSpy = getMaxSpy();
                if (spy > maxSpy) {
                    document.getElementById('spy-count').textContent = maxSpy;
                    updateCivilian();
                }
            }
        }

        function increaseRole(role) {
            if (role === 'civilian') {
                // Civilian tidak bisa diubah manual
                return;
            }

            const countElement = document.getElementById(role + '-count');
            let count = parseInt(countElement.textContent);
            const totalPlayers = getTotalPlayers();
            const civilian = parseInt(document.getElementById('civilian-count').textContent);
            const spy = parseInt(document.getElementById('spy-count').textContent);

            if (role === 'spy') {
                const maxSpy = getMaxSpy();
                if (count >= maxSpy) {
                    showNotification(`Maksimal spy untuk ${totalPlayers} pemain adalah ${maxSpy}!`);
                    return;
                }

                // Cek apakah setelah ditambah, spy akan sama dengan civilian
                const newSpy = count + 1;
                const newCivilian = totalPlayers - newSpy - parseInt(document.getElementById('mrwhite-count').textContent);
                if (newSpy === newCivilian) {
                    showNotification('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                    return;
                }
            }

            if (role === 'mrwhite') {
                const maxMrWhite = getMaxMrWhite();
                if (count >= maxMrWhite) {
                    showNotification(`Maksimal mr.white untuk ${totalPlayers} pemain adalah ${maxMrWhite}!`);
                    return;
                }

                // Cek apakah setelah ditambah, mr.white akan sama dengan civilian
                const newMrwhite = count + 1;
                const newCivilian = totalPlayers - spy - newMrwhite;
                if (newMrwhite === newCivilian) {
                    showNotification('Jumlah mr.white tidak boleh sama dengan jumlah civilian!');
                    return;
                }

                // Cek apakah spy akan sama dengan civilian setelah mr.white ditambah
                if (spy === newCivilian) {
                    showNotification('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                    return;
                }
            }

            // Cek apakah masih ada civilian yang bisa dikurangi
            if (civilian > 0) {
                countElement.textContent = count + 1;
                updateCivilian();
            } else {
                showNotification('Tidak ada ruang untuk menambah role ini!');
            }
        }

        function decreaseRole(role) {
            if (role === 'civilian') {
                // Civilian tidak bisa diubah manual
                return;
            }

            const countElement = document.getElementById(role + '-count');
            let count = parseInt(countElement.textContent);
            const totalPlayers = getTotalPlayers();
            const spy = parseInt(document.getElementById('spy-count').textContent);
            const mrwhite = parseInt(document.getElementById('mrwhite-count').textContent);

            if (count > 0) {
                if (role === 'spy') {
                    // Cek apakah setelah dikurangi, spy akan sama dengan civilian
                    const newSpy = count - 1;
                    const newCivilian = totalPlayers - newSpy - mrwhite;
                    if (newSpy === newCivilian && newSpy > 0) {
                        showNotification('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                        return;
                    }
                }

                if (role === 'mrwhite') {
                    // Cek apakah setelah dikurangi, mr.white akan sama dengan civilian
                    const newMrwhite = count - 1;
                    const newCivilian = totalPlayers - spy - newMrwhite;
                    if (newMrwhite === newCivilian && newMrwhite > 0) {
                        showNotification('Jumlah mr.white tidak boleh sama dengan jumlah civilian!');
                        return;
                    }

                    // Cek apakah spy akan sama dengan civilian setelah mr.white dikurangi
                    if (spy === newCivilian && spy > 0) {
                        showNotification('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                        return;
                    }
                }

                countElement.textContent = count - 1;
                updateCivilian();
            }
        }

        function startGame() {
            const totalPlayers = getTotalPlayers();
            const civilian = parseInt(document.getElementById('civilian-count').textContent);
            const spy = parseInt(document.getElementById('spy-count').textContent);
            const mrwhite = parseInt(document.getElementById('mrwhite-count').textContent);

            const currentRoles = civilian + spy + mrwhite;

            if (currentRoles !== totalPlayers) {
                showNotification(`Jumlah role (${currentRoles}) harus sama dengan total pemain (${totalPlayers})!`);
                return;
            }

            if (totalPlayers < 3) {
                showNotification('Minimal 3 pemain untuk memulai permainan!');
                return;
            }

            if (spy === 0 && mrwhite === 0) {
                showNotification('Harus ada minimal 1 spy atau 1 mr.white!');
                return;
            }

            if (civilian < 1) {
                showNotification('Harus ada minimal 1 civilian!');
                return;
            }

            if (spy === civilian) {
                showNotification('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                return;
            }

            if (mrwhite === civilian && mrwhite > 0) {
                showNotification('Jumlah mr.white tidak boleh sama dengan jumlah civilian!');
                return;
            }

            // Redirect to game page with parameters
            window.location.href = `/undercover/play?civilian=${civilian}&spy=${spy}&mrwhite=${mrwhite}`;
        }
    </script>
</body>
</html>
