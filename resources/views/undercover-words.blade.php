<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undercover - Tambah Kata</title>
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
            align-items: flex-start;
            padding: 20px;
            position: relative;
            background: #0a0e27;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(10, 14, 39, 0.4) 0%, rgba(10, 14, 39, 0.82) 100%),
                radial-gradient(circle at top, rgba(138, 100, 255, 0.18), transparent 35%),
                radial-gradient(circle at bottom right, rgba(100, 149, 237, 0.16), transparent 30%);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 900px;
            background: rgba(15, 20, 45, 0.9);
            border: 1px solid rgba(138, 100, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), inset 0 0 50px rgba(138, 100, 255, 0.05);
            padding: 32px;
            animation: floatCard 5s ease-in-out infinite;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .header {
            margin-bottom: 24px;
            text-align: center;
        }

        h1 {
            color: #ffffff;
            font-size: 2.3rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #b8b8d1;
            font-size: 0.98rem;
            line-height: 1.6;
        }

        .flash {
            background: rgba(100, 149, 237, 0.14);
            border: 1px solid rgba(100, 149, 237, 0.45);
            color: #dce8ff;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.72);
            backdrop-filter: blur(5px);
            z-index: 50;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .popup-overlay.show {
            display: flex;
        }

        .popup {
            width: 100%;
            max-width: 420px;
            background: rgba(15, 20, 45, 0.96);
            border: 2px solid rgba(138, 100, 255, 0.5);
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7);
            animation: popupIn 0.25s ease;
        }

        .popup-title {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .popup-message {
            color: #b8b8d1;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        @keyframes popupIn {
            from { transform: translateY(20px) scale(0.96); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .card {
            background: rgba(20, 25, 50, 0.62);
            border: 1px solid rgba(138, 100, 255, 0.25);
            border-radius: 18px;
            padding: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        label {
            display: block;
            color: #b8b8d1;
            font-size: 0.92rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            background: rgba(20, 25, 50, 0.8);
            border: 1px solid rgba(138, 100, 255, 0.4);
            border-radius: 12px;
            padding: 14px 16px;
            color: #ffffff;
            font-size: 1rem;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: rgba(138, 100, 255, 0.85);
            box-shadow: 0 0 0 3px rgba(138, 100, 255, 0.12);
        }

        .error {
            color: #ff9090;
            font-size: 0.85rem;
            margin-top: 8px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .btn {
            border: none;
            border-radius: 999px;
            padding: 14px 22px;
            font-size: 0.98rem;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8a64ff 0%, #6b46d6 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(138, 100, 255, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(138, 100, 255, 0.45);
        }

        .btn-secondary {
            background: transparent;
            color: #b8b8d1;
            border: 1px solid rgba(184, 184, 209, 0.3);
        }

        .btn-secondary:hover {
            border-color: rgba(184, 184, 209, 0.55);
            color: #ffffff;
            background: rgba(184, 184, 209, 0.08);
        }

        @media (max-width: 720px) {
            .container {
                padding: 22px;
            }

            h1 {
                font-size: 1.7rem;
                letter-spacing: 2px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .word-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .word-meta {
                white-space: normal;
            }

            .actions .btn {
                width: 100%;
            }
        }

            @media (max-width: 720px) {
                .container {
                    animation-duration: 6s;
                }
            }
    </style>
</head>
<body>
        <div class="popup-overlay {{ ($errors->any() || session('success')) ? 'show' : '' }}" id="wordPopup" onclick="closeWordPopup()">
            <div class="popup" onclick="event.stopPropagation()">
                <div class="popup-title">Informasi Kata</div>
                <div class="popup-message">
                    @if (session('success'))
                        {{ session('success') }}
                    @elseif ($errors->any())
                        {{ $errors->first() }}
                    @else
                        Kata berhasil diproses.
                    @endif
                </div>
                <button type="button" class="btn btn-primary" onclick="closeWordPopup()">OK</button>
            </div>
        </div>

    <div class="container">
        <div class="header">
            <h1>Tambah Kata</h1>
            <p class="subtitle">Tambahkan pasangan kata baru ke database agar bisa dipakai saat bermain Undercover.</p>
        </div>

        <div class="card">
            <form method="POST" action="/undercover/words">
                @csrf
                <div class="form-grid">
                    <div>
                        <label for="kata1">Kata Civilian</label>
                        <input type="text" id="kata1" name="kata1" value="{{ old('kata1') }}" placeholder="Contoh: APEL">
                        @error('kata1')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="kata2">Kata Spy</label>
                        <input type="text" id="kata2" name="kata2" value="{{ old('kata2') }}" placeholder="Contoh: JERUK">
                        @error('kata2')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Simpan Kata</button>
                    <a href="/" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeWordPopup() {
            document.getElementById('wordPopup').classList.remove('show');
        }
    </script>
</body>
</html>
