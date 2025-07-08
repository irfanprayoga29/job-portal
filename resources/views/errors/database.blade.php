<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection Error</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            max-width: 600px;
            background: rgba(255,255,255,0.1);
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        .steps {
            text-align: left;
            margin: 30px 0;
            background: rgba(0,0,0,0.2);
            padding: 20px;
            border-radius: 10px;
        }
        .steps h3 {
            margin-top: 0;
        }
        .steps ol {
            margin: 0;
            padding-left: 20px;
        }
        .steps li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Database Setup Required</h1>
        <p>{{ $message ?? 'The application cannot connect to the database.' }}</p>
        
        <div class="steps">
            <h3>To fix this issue:</h3>
            <ol>
                <li><strong>Install MySQL:</strong> Download and install MySQL from <a href="https://dev.mysql.com/downloads/mysql/" style="color: #fff;">mysql.com</a></li>
                <li><strong>Create Database:</strong> Create a database named <code>job_portal4</code></li>
                <li><strong>Update .env:</strong> Ensure your database credentials are correct</li>
                <li><strong>Run Migrations:</strong> Execute <code>php artisan migrate</code></li>
            </ol>
        </div>
        
        <p>Once the database is set up, refresh this page.</p>
        
        <a href="/" class="btn">🔄 Refresh Page</a>
        <a href="/simple-test" class="btn">📝 Test Without Database</a>
    </div>
</body>
</html>
