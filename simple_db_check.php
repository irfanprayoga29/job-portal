<?php
// Simple database check without Laravel dependencies
$databasePath = __DIR__ . '/database/database.sqlite';

echo "Checking database at: $databasePath\n";

if (!file_exists($databasePath)) {
    echo "Database file does not exist. Creating it...\n";
    touch($databasePath);
}

try {
    $pdo = new PDO("sqlite:$databasePath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully\n";
    
    // Check if applications table exists
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='applications'");
    if ($stmt->fetch()) {
        echo "Applications table exists\n";
        
        // Get table info
        $stmt = $pdo->query("PRAGMA table_info(applications)");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Table structure:\n";
        foreach ($columns as $column) {
            echo "  - {$column['name']} ({$column['type']})\n";
        }
        
        // Check if cover_letter column exists
        $hascover_letter = false;
        foreach ($columns as $column) {
            if ($column['name'] === 'cover_letter') {
                $hascover_letter = true;
                break;
            }
        }
        
        if (!$hascover_letter) {
            echo "\nAdding cover_letter column...\n";
            $pdo->exec("ALTER TABLE applications ADD COLUMN cover_letter TEXT");
            echo "cover_letter column added successfully!\n";
        } else {
            echo "\ncover_letter column already exists\n";
        }
        
    } else {
        echo "Applications table does not exist\n";
        echo "You may need to run Laravel migrations first\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
