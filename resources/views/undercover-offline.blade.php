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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
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
            padding: 40px 35px;
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
            margin-bottom: 10px;
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
            margin-bottom: 15px;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .player-total-box {
            background: rgba(138, 100, 255, 0.15);
            border: 2px solid rgba(138, 100, 255, 0.4);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
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
            gap: 15px;
            margin-bottom: 30px;
        }

        .role-item {
            background: rgba(20, 25, 50, 0.6);
            border: 1px solid rgba(138, 100, 255, 0.3);
            border-radius: 15px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .role-item:hover {
            background: rgba(30, 35, 60, 0.7);
            border-color: rgba(138, 100, 255, 0.5);
            box-shadow: 0 4px 20px rgba(138, 100, 255, 0.2);
        }

        .role-icon {
            width: 60px;
            height: 60px;
        }

        .role-icon svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 2px 8px rgba(255, 255, 255, 0.2));
        }

        .role-name {
            font-size: 1rem;
            color: #ffffff;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.5px;
        }

        .role-counter {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 5px;
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
            transform: scale(1.05);
        }

        .counter-btn:active {
            transform: scale(0.95);
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
            padding: 18px 60px;
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
            transform: translateY(-2px);
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
            margin-top: 15px;
            width: 100%;
        }

        .back-btn:hover {
            background: rgba(184, 184, 209, 0.1);
            border-color: rgba(184, 184, 209, 0.5);
            color: #ffffff;
        }

        /* Desktop Styles */
        @media (min-width: 768px) {
            .container {
                max-width: 500px;
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

            .role-item {
                padding: 25px;
                gap: 15px;
            }

            .role-icon {
                width: 70px;
                height: 70px;
            }

            .role-name {
                font-size: 1.1rem;
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

        /* Mobile Styles */
        @media (max-width: 600px) {
            .container {
                padding: 35px 25px;
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
                padding: 18px;
            }

            .role-icon {
                width: 55px;
                height: 55px;
            }

            .role-name {
                font-size: 0.95rem;
            }

            .counter-btn {
                width: 32px;
                height: 32px;
                font-size: 1.2rem;
            }

            .counter-value {
                font-size: 1.3rem;
                min-width: 25px;
            }

            .start-btn {
                padding: 16px 50px;
                font-size: 1.1rem;
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
            <div class="role-item">
                <div class="role-icon">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="100" cy="45" rx="70" ry="12" fill="#ffffff"/>
                        <rect x="60" y="45" width="80" height="25" rx="5" fill="#ffffff"/>
                        <rect x="50" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                        <rect x="105" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                        <rect x="95" y="92" width="10" height="8" fill="#ffffff"/>
                        <circle cx="100" cy="100" r="55" fill="#ffffff" opacity="0.1"/>
                        <path d="M85 130 L100 160 L115 130 Z" fill="#ffffff"/>
                        <rect x="75" y="130" width="50" height="15" fill="#ffffff"/>
                        <path d="M60 145 L60 180 L85 175 L85 145 Z" fill="#ffffff"/>
                        <path d="M140 145 L140 180 L115 175 L115 145 Z" fill="#ffffff"/>
                    </svg>
                </div>
                <div class="role-name">Civilian (Warga)</div>
                <div class="role-counter">
                    <button class="counter-btn" onclick="decreaseRole('civilian')">−</button>
                    <span class="counter-value" id="civilian-count">2</span>
                    <button class="counter-btn" onclick="increaseRole('civilian')">+</button>
                </div>
            </div>

            <!-- Spy Role -->
            <div class="role-item">
                <div class="role-icon">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="100" cy="45" rx="70" ry="12" fill="#ffffff"/>
                        <rect x="60" y="45" width="80" height="25" rx="5" fill="#ffffff"/>
                        <rect x="50" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                        <rect x="105" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                        <rect x="95" y="92" width="10" height="8" fill="#ffffff"/>
                        <circle cx="100" cy="100" r="55" fill="#ffffff" opacity="0.1"/>
                        <path d="M85 130 L100 160 L115 130 Z" fill="#ffffff"/>
                        <rect x="75" y="130" width="50" height="15" fill="#ffffff"/>
                        <path d="M60 145 L60 180 L85 175 L85 145 Z" fill="#ffffff"/>
                        <path d="M140 145 L140 180 L115 175 L115 145 Z" fill="#ffffff"/>
                    </svg>
                </div>
                <div class="role-name">spy</div>
                <div class="role-counter">
                    <button class="counter-btn" onclick="decreaseRole('spy')">−</button>
                    <span class="counter-value" id="spy-count">1</span>
                    <button class="counter-btn" onclick="increaseRole('spy')">+</button>
                </div>
            </div>

            <!-- Mr. White Role -->
            <div class="role-item">
                <div class="role-icon">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="100" cy="45" rx="70" ry="12" fill="#ffffff"/>
                        <rect x="60" y="45" width="80" height="25" rx="5" fill="#ffffff"/>
                        <rect x="50" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                        <rect x="105" y="85" width="45" height="25" rx="12" fill="#1a1a1a"/>
                        <rect x="95" y="92" width="10" height="8" fill="#ffffff"/>
                        <circle cx="100" cy="100" r="55" fill="#ffffff" opacity="0.1"/>
                        <path d="M85 130 L100 160 L115 130 Z" fill="#ffffff"/>
                        <rect x="75" y="130" width="50" height="15" fill="#ffffff"/>
                        <path d="M60 145 L60 180 L85 175 L85 145 Z" fill="#ffffff"/>
                        <path d="M140 145 L140 180 L115 175 L115 145 Z" fill="#ffffff"/>
                    </svg>
                </div>
                <div class="role-name">mr.white</div>
                <div class="role-counter">
                    <button class="counter-btn" onclick="decreaseRole('mrwhite')">−</button>
                    <span class="counter-value" id="mrwhite-count">0</span>
                    <button class="counter-btn" onclick="increaseRole('mrwhite')">+</button>
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

    <script>
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
                    alert(`Maksimal spy untuk ${totalPlayers} pemain adalah ${maxSpy}!`);
                    return;
                }

                // Cek apakah setelah ditambah, spy akan sama dengan civilian
                const newSpy = count + 1;
                const newCivilian = totalPlayers - newSpy - parseInt(document.getElementById('mrwhite-count').textContent);
                if (newSpy === newCivilian) {
                    alert('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                    return;
                }
            }

            if (role === 'mrwhite') {
                const maxMrWhite = getMaxMrWhite();
                if (count >= maxMrWhite) {
                    alert(`Maksimal mr.white untuk ${totalPlayers} pemain adalah ${maxMrWhite}!`);
                    return;
                }

                // Cek apakah setelah ditambah, mr.white akan sama dengan civilian
                const newMrwhite = count + 1;
                const newCivilian = totalPlayers - spy - newMrwhite;
                if (newMrwhite === newCivilian) {
                    alert('Jumlah mr.white tidak boleh sama dengan jumlah civilian!');
                    return;
                }

                // Cek apakah spy akan sama dengan civilian setelah mr.white ditambah
                if (spy === newCivilian) {
                    alert('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                    return;
                }
            }

            // Cek apakah masih ada civilian yang bisa dikurangi
            if (civilian > 0) {
                countElement.textContent = count + 1;
                updateCivilian();
            } else {
                alert('Tidak ada ruang untuk menambah role ini!');
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
                        alert('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                        return;
                    }
                }

                if (role === 'mrwhite') {
                    // Cek apakah setelah dikurangi, mr.white akan sama dengan civilian
                    const newMrwhite = count - 1;
                    const newCivilian = totalPlayers - spy - newMrwhite;
                    if (newMrwhite === newCivilian && newMrwhite > 0) {
                        alert('Jumlah mr.white tidak boleh sama dengan jumlah civilian!');
                        return;
                    }

                    // Cek apakah spy akan sama dengan civilian setelah mr.white dikurangi
                    if (spy === newCivilian && spy > 0) {
                        alert('Jumlah spy tidak boleh sama dengan jumlah civilian!');
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
                alert(`Jumlah role (${currentRoles}) harus sama dengan total pemain (${totalPlayers})!`);
                return;
            }

            if (totalPlayers < 3) {
                alert('Minimal 3 pemain untuk memulai permainan!');
                return;
            }

            if (spy === 0 && mrwhite === 0) {
                alert('Harus ada minimal 1 spy atau 1 mr.white!');
                return;
            }

            if (civilian < 1) {
                alert('Harus ada minimal 1 civilian!');
                return;
            }

            if (spy === civilian) {
                alert('Jumlah spy tidak boleh sama dengan jumlah civilian!');
                return;
            }

            if (mrwhite === civilian && mrwhite > 0) {
                alert('Jumlah mr.white tidak boleh sama dengan jumlah civilian!');
                return;
            }

            // Redirect to game page with parameters
            window.location.href = `/undercover/play?civilian=${civilian}&spy=${spy}&mrwhite=${mrwhite}`;
        }
    </script>
</body>
</html>
