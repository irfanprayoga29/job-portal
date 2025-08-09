<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halo Kamu - Job Portal</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .greeting-container {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .greeting-title {
            font-size: 3rem;
            color: #333;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .greeting-subtitle {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 2rem;
        }
        .greeting-message {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .back-link {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .back-link:hover {
            background: #5a6fd8;
        }
        .emoji {
            font-size: 2rem;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="greeting-container">
        <h1 class="greeting-title">
            <span class="emoji">👋</span>
            Halo Kamu!
            <span class="emoji">🎉</span>
        </h1>
        <p class="greeting-subtitle">Selamat datang di Job Portal</p>
        <div class="greeting-message">
            <p>Halo dan selamat datang! Kami sangat senang Anda berkunjung ke portal lowongan kerja kami.</p>
            <p>Semoga Anda menemukan pekerjaan yang sesuai dengan minat dan kemampuan Anda.</p>
            <p><strong>Selamat mencari kerja!</strong></p>
        </div>
        <a href="/" class="back-link">Kembali ke Beranda</a>
    </div>
</body>
</html>