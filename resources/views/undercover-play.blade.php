<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undercover - Bermain</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            position: relative;
            background: #0a0e27;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(10, 14, 39, 0.4) 0%, rgba(10, 14, 39, 0.8) 100%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><rect fill="%230a0e27"/><g opacity="0.3"><rect x="100" y="50" width="80" height="200" fill="%231a2456"/><rect x="300" y="100" width="60" height="300" fill="%23152040"/><rect x="500" y="80" width="100" height="250" fill="%231a2456"/><rect x="800" y="120" width="70" height="180" fill="%23152040"/><rect x="1000" y="60" width="90" height="280" fill="%231a2456"/><rect x="1200" y="90" width="75" height="220" fill="%23152040"/><rect x="1400" y="110" width="85" height="260" fill="%231a2456"/><rect x="1600" y="70" width="95" height="240" fill="%23152040"/></g></svg>');
            background-size: cover;
            background-position: center;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: -100%;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(transparent 0%, transparent 50%, rgba(255,255,255,0.03) 50%, rgba(255,255,255,0.03) 100%);
            background-size: 2px 20px;
            animation: rain 0.3s linear infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes rain {
            0% { transform: translateY(0); }
            100% { transform: translateY(20px); }
        }

        /* Hide scrollbar for desktop */
        @media (min-width: 769px) {
            body::-webkit-scrollbar {
                display: none;
            }

            body {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }

        .container {
            background: rgba(15, 20, 45, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), inset 0 0 50px rgba(138, 100, 255, 0.05);
            text-align: center;
            max-width: 900px;
            width: 100%;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(138, 100, 255, 0.2);
        }

        h1 {
            font-size: 2rem;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 20px rgba(138, 100, 255, 0.5), 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .phase-title {
            font-size: 1.2rem;
            color: #8a64ff;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .instructions {
            background: rgba(138, 100, 255, 0.1);
            border-left: 3px solid rgba(138, 100, 255, 0.6);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: left;
        }

        .instructions p {
            font-size: 0.9rem;
            color: #b8b8d1;
            line-height: 1.6;
            margin: 0;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin: 25px 0;
        }

        .card {
            background: rgba(20, 25, 50, 0.6);
            border: 2px solid rgba(138, 100, 255, 0.3);
            border-radius: 15px;
            padding: 30px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card:hover:not(.picked):not(.revealed) {
            transform: translateY(-5px);
            border-color: rgba(138, 100, 255, 0.6);
            box-shadow: 0 8px 25px rgba(138, 100, 255, 0.3);
        }

        .card-number {
            font-size: 1.5rem;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card-status {
            font-size: 0.85rem;
            color: #8a64ff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card.picked {
            background: rgba(138, 100, 255, 0.15);
            border-color: rgba(138, 100, 255, 0.5);
            cursor: not-allowed;
            opacity: 0.5;
        }

        .card.revealed {
            cursor: pointer;
        }

        .card.revealed.civilian {
            background: rgba(100, 149, 237, 0.2);
            border-color: rgba(100, 149, 237, 0.6);
        }

        .card.revealed.spy {
            background: rgba(220, 53, 69, 0.2);
            border-color: rgba(220, 53, 69, 0.6);
        }

        .card.revealed.mrwhite {
            background: rgba(255, 193, 7, 0.2);
            border-color: rgba(255, 193, 7, 0.6);
        }

        .card-word {
            font-size: 1.1rem;
            color: #ffffff;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn {
            padding: 16px 40px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: none;
            margin-top: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8a64ff 0%, #6b46d6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(138, 100, 255, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(138, 100, 255, 0.6);
        }

        .btn-secondary {
            background: transparent;
            color: #b8b8d1;
            border: 1px solid rgba(184, 184, 209, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(184, 184, 209, 0.1);
            border-color: rgba(184, 184, 209, 0.5);
            color: #ffffff;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: rgba(15, 20, 45, 0.95);
            border: 2px solid rgba(138, 100, 255, 0.5);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            animation: slideIn 0.3s ease;
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

        .modal-title {
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .modal-word {
            font-size: 2.5rem;
            color: #8a64ff;
            margin: 20px 0;
            font-weight: 900;
            text-shadow: 0 0 20px rgba(138, 100, 255, 0.6);
        }

        .modal-role {
            font-size: 1.2rem;
            color: #ffa500;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .modal-text {
            font-size: 1rem;
            color: #b8b8d1;
            line-height: 1.6;
            margin: 15px 0;
        }

        .game-result {
            background: rgba(138, 100, 255, 0.15);
            border: 2px solid rgba(138, 100, 255, 0.4);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }

        .result-title {
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .result-text {
            font-size: 1.1rem;
            color: #b8b8d1;
            margin: 10px 0;
        }

        input[type="text"] {
            background: rgba(20, 25, 50, 0.6);
            border: 2px solid rgba(138, 100, 255, 0.4);
            border-radius: 10px;
            padding: 15px;
            font-size: 1.2rem;
            color: #ffffff;
            text-align: center;
            width: 100%;
            margin: 20px 0;
        }

        input[type="text"]::placeholder {
            color: #666;
        }

        @media (max-width: 768px) {
            body {
                align-items: flex-start;
                padding: 15px;
            }

            .container {
                margin: 0 auto;
            }

            .cards-grid {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 10px;
            }

            .card {
                min-height: 120px;
                padding: 20px 15px;
            }

            .card-number {
                font-size: 1.2rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>UNDERCOVER</h1>

        <div id="pick-phase">
            <div class="phase-title">Fase Pemilihan Kartu</div>
            <div class="instructions">
                <p>🎴 Setiap pemain memilih satu kartu. Setelah memilih, pemain akan melihat kata mereka. Jangan beritahu pemain lain!</p>
            </div>

            <div class="cards-grid" id="cards-grid"></div>
        </div>

        <div id="voting-phase" style="display: none;">
            <div class="phase-title">Fase Voting</div>
            <div class="instructions">
                <p>🗳️ Diskusikan dan klik kartu untuk membuka identitas pemain. Temukan siapa yang spy!</p>
            </div>

            <div class="cards-grid" id="voting-grid"></div>

            <div id="game-result" class="game-result" style="display: none;"></div>
        </div>

        <button class="btn btn-secondary" onclick="location.href='/undercover/offline'">
            Kembali ke Pengaturan
        </button>
    </div>

    <!-- Modal untuk menampilkan kata -->
    <div id="word-modal" class="modal">
        <div class="modal-content">
            <div class="modal-title" id="modal-title">Kartu Anda</div>
            <div class="modal-role" id="modal-role" style="display: none;"></div>
            <div class="modal-word" id="modal-word"></div>
            <div class="modal-text" id="modal-text"></div>
            <button class="btn btn-primary" onclick="closeModal()">OK, Saya Sudah Hafal</button>
        </div>
    </div>

    <!-- Modal untuk Mr. White guess -->
    <div id="guess-modal" class="modal">
        <div class="modal-content">
            <div class="modal-title">Mr. White Terbuka!</div>
            <div class="modal-text">Mr. White, tebak kata yang dimiliki Civilian:</div>
            <input type="text" id="guess-input" placeholder="Masukkan kata tebakan">
            <button class="btn btn-primary" onclick="submitGuess()">Tebak</button>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const totalCivilian = parseInt(urlParams.get('civilian')) || 2;
        const totalSpy = parseInt(urlParams.get('spy')) || 1;
        const totalMrWhite = parseInt(urlParams.get('mrwhite')) || 0;
        const totalPlayers = totalCivilian + totalSpy + totalMrWhite;

        const wordPairs = [
            { kata1: 'APEL', kata2: 'JERUK' },
            { kata1: 'KUCING', kata2: 'ANJING' },
            { kata1: 'MOBIL', kata2: 'MOTOR' },
            { kata1: 'BUKU', kata2: 'MAJALAH' },
            { kata1: 'KOPI', kata2: 'TEH' },
            { kata1: 'NASI', kata2: 'ROTI' },
            { kata1: 'PENSIL', kata2: 'PULPEN' }
        ];

        const selectedPair = wordPairs[Math.floor(Math.random() * wordPairs.length)];
        const civilianWord = selectedPair.kata1;
        const spyWord = selectedPair.kata2;

        let cards = [];
        for (let i = 0; i < totalCivilian; i++) {
            cards.push({ role: 'civilian', word: civilianWord, picked: false, revealed: false });
        }
        for (let i = 0; i < totalSpy; i++) {
            cards.push({ role: 'spy', word: spyWord, picked: false, revealed: false });
        }
        for (let i = 0; i < totalMrWhite; i++) {
            cards.push({ role: 'mrwhite', word: null, picked: false, revealed: false });
        }

        // Fisher-Yates shuffle untuk mengacak kartu dengan sempurna
        for (let i = cards.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [cards[i], cards[j]] = [cards[j], cards[i]];
        }

        let pickedCount = 0;

        function renderCards() {
            const grid = document.getElementById('cards-grid');
            grid.innerHTML = '';

            cards.forEach((card, index) => {
                const cardEl = document.createElement('div');
                cardEl.className = 'card';
                if (card.picked) cardEl.classList.add('picked');

                cardEl.innerHTML = `
                    <div class="card-number">#${index + 1}</div>
                    <div class="card-status">${card.picked ? 'Dipilih' : 'Tersedia'}</div>
                `;

                if (!card.picked) {
                    cardEl.onclick = () => pickCard(index);
                }

                grid.appendChild(cardEl);
            });
        }

        function pickCard(index) {
            cards[index].picked = true;
            pickedCount++;

            const card = cards[index];
            const modal = document.getElementById('word-modal');

            if (card.role === 'mrwhite') {
                document.getElementById('modal-title').textContent = 'Anda Adalah...';
                document.getElementById('modal-role').textContent = '⚠️ MR. WHITE ⚠️';
                document.getElementById('modal-role').style.display = 'block';
                document.getElementById('modal-word').textContent = 'TIDAK ADA KATA';
                document.getElementById('modal-text').textContent = 'Anda Mr. White! Dengarkan diskusi dengan seksama dan coba tebak kata civilian.';
            } else {
                document.getElementById('modal-title').textContent = 'Kata Anda';
                document.getElementById('modal-role').style.display = 'none';
                document.getElementById('modal-word').textContent = card.word;
                document.getElementById('modal-text').textContent = 'Hafalkan kata ini. Jangan beritahu siapapun!';
            }

            modal.classList.add('show');
            renderCards();
        }

        function closeModal() {
            document.getElementById('word-modal').classList.remove('show');

            if (pickedCount === totalPlayers) {
                document.getElementById('pick-phase').style.display = 'none';
                document.getElementById('voting-phase').style.display = 'block';
                renderVotingCards();
            }
        }

        function renderVotingCards() {
            const grid = document.getElementById('voting-grid');
            grid.innerHTML = '';

            cards.forEach((card, index) => {
                const cardEl = document.createElement('div');
                cardEl.className = 'card revealed';
                if (card.revealed) cardEl.classList.add(card.role);

                let content = `<div class="card-number">#${index + 1}</div>`;
                if (card.revealed) {
                    content += `<div class="card-status">${card.role === 'civilian' ? 'CIVILIAN' : card.role === 'spy' ? 'SPY' : 'MR. WHITE'}</div>`;
                    if (card.word) {
                        content += `<div class="card-word">${card.word}</div>`;
                    }
                } else {
                    content += `<div class="card-status">Klik untuk Buka</div>`;
                }

                cardEl.innerHTML = content;

                if (!card.revealed) {
                    cardEl.onclick = () => revealCard(index);
                }

                grid.appendChild(cardEl);
            });
        }

        function revealCard(index) {
            const card = cards[index];
            card.revealed = true;

            if (card.role === 'mrwhite') {
                document.getElementById('guess-modal').classList.add('show');
                renderVotingCards();
            } else {
                renderVotingCards();
                checkGameEnd();
            }
        }

        function submitGuess() {
            const guess = document.getElementById('guess-input').value.trim().toUpperCase();
            document.getElementById('guess-modal').classList.remove('show');

            const resultDiv = document.getElementById('game-result');
            if (guess === civilianWord) {
                resultDiv.innerHTML = `
                    <div class="result-title">🎉 MR. WHITE MENANG! 🎉</div>
                    <div class="result-text">Mr. White berhasil menebak kata civilian: <strong>${civilianWord}</strong></div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="result-title">❌ MR. WHITE KALAH ❌</div>
                    <div class="result-text">Tebakan: <strong>${guess}</strong></div>
                    <div class="result-text">Kata yang benar: <strong>${civilianWord}</strong></div>
                `;
            }
            resultDiv.style.display = 'block';
            renderVotingCards();
        }

        function checkGameEnd() {
            const revealedCivilian = cards.filter(c => c.revealed && c.role === 'civilian').length;
            const revealedSpy = cards.filter(c => c.revealed && c.role === 'spy').length;
            const totalRevealedSpy = cards.filter(c => c.role === 'spy').length;
            const remainingCivilian = totalCivilian - revealedCivilian;
            const remainingSpy = totalSpy - revealedSpy;

            const resultDiv = document.getElementById('game-result');

            if (revealedSpy === totalRevealedSpy) {
                resultDiv.innerHTML = `
                    <div class="result-title">🎉 CIVILIAN MENANG! 🎉</div>
                    <div class="result-text">Semua spy telah ditemukan!</div>
                    <div class="result-text">Kata Civilian: <strong>${civilianWord}</strong></div>
                    <div class="result-text">Kata Spy: <strong>${spyWord}</strong></div>
                `;
                resultDiv.style.display = 'block';
            } else if (remainingCivilian <= remainingSpy && remainingCivilian > 0) {
                resultDiv.innerHTML = `
                    <div class="result-title">🎭 SPY MENANG! 🎭</div>
                    <div class="result-text">Jumlah civilian tersisa (${remainingCivilian}) ≤ spy tersisa (${remainingSpy})</div>
                    <div class="result-text">Kata Civilian: <strong>${civilianWord}</strong></div>
                    <div class="result-text">Kata Spy: <strong>${spyWord}</strong></div>
                `;
                resultDiv.style.display = 'block';
            }
        }

        renderCards();
    </script>
</body>
</html>
