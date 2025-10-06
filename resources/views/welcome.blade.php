<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebMusic - Ứng dụng âm nhạc</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            font-family: 'Roboto', Arial, sans-serif;
            color: #fff;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .music-logo {
            width: 120px;
            margin-bottom: 24px;
            filter: drop-shadow(0 4px 16px #0008);
        }
        .main-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }
        .subtitle {
            font-size: 1.2rem;
            margin-bottom: 32px;
            color: #e0e0e0;
        }
        .music-player-demo {
            background: rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 32px 40px;
            box-shadow: 0 8px 32px #0004;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .music-player-demo i {
            font-size: 2.5rem;
            margin: 0 18px;
            color: #ffd700;
        }
        .music-player-demo .song-title {
            font-size: 1.3rem;
            font-weight: 500;
            margin: 18px 0 6px 0;
        }
        .music-player-demo .artist {
            font-size: 1rem;
            color: #b3c6ff;
        }
        .btn-start {
            margin-top: 32px;
            background: #ffd700;
            color: #1e3c72;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 12px 32px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-start:hover {
            background: #fff;
        }
        @media (max-width: 600px) {
            .music-player-demo { padding: 18px 8px; }
            .main-title { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <img src="/images/custom-logo.jpg" alt="WebMusic Logo" class="music-logo">
    <div class="main-title">WebMusic</div>
    <div class="subtitle">Khám phá, quản lý và thưởng thức âm nhạc mọi lúc mọi nơi!</div>
    <div class="music-player-demo">
        <div>
            <i class="fas fa-backward"></i>
            <i class="fas fa-play-circle"></i>
            <i class="fas fa-forward"></i>
        </div>
        <div class="song-title">Sample Song - Demo</div>
        <div class="artist">by WebMusic Artist</div>
    </div>
    <a href="{{ route('login') }}" class="btn-start">Bắt đầu ngay</a>
</body>
</html>
