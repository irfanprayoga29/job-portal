<?php
require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Load Laravel configuration
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Get database configuration
    $config = config('database.connections.' . config('database.default'));
    
    if ($config['driver'] === 'sqlite') {
        $database = $config['database'];
        if (!file_exists($database)) {
            echo "Creating SQLite database file: $database\n";
            touch($database);
        }
        
        $pdo = new PDO("sqlite:$database");
        echo "Connected to SQLite database\n";
        
        // Check if applications table exists
        $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='applications'");
        if ($stmt && $stmt->fetch()) {
            echo "Applications table found\n";
            
            // Check if cover_letter column exists
            $stmt = $pdo->query("PRAGMA table_info(applications)");
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $hascover_letter = false;
            foreach ($columns as $column) {
                if ($column['name'] === 'cover_letter') {
                    $hascover_letter = true;
                    break;
                }
            }
            
            if (!$hascover_letter) {
                echo "Adding cover_letter column...\n";
                $pdo->exec("ALTER TABLE applications ADD COLUMN cover_letter TEXT");
                echo "cover_letter column added successfully!\n";
                
                // Update the Application model to include cover_letter
                $modelFile = __DIR__ . '/app/Models/Application.php';
                $content = file_get_contents($modelFile);
                $content = str_replace(
                    "// 'cover_letter', // Temporarily disabled until column is added",
                    "'cover_letter',",
                    $content
                );
                file_put_contents($modelFile, $content);
                echo "Application model updated to include cover_letter\n";
            } else {
                echo "cover_letter column already exists\n";
            }
        } else {
            echo "Applications table not found\n";
        }
    } else {
        echo "MySQL configuration detected but driver not available\n";
        echo "Please install php-mysql or switch to SQLite\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
?>
