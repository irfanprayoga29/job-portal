<?php
// Simple SQLite database fix
$databasePath = __DIR__ . '/database/database.sqlite';

if (!file_exists($databasePath)) {
    echo "Database file does not exist at: $databasePath\n";
    exit(1);
}

try {
    $pdo = new PDO("sqlite:$databasePath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database\n";
    
    // Check if applications table exists and get its structure
    $stmt = $pdo->query("SELECT sql FROM sqlite_master WHERE type='table' AND name='applications'");
    $tableStructure = $stmt->fetchColumn();
    
    if (!$tableStructure) {
        echo "Applications table not found\n";
        exit(1);
    }
    
    echo "Applications table exists\n";
    echo "Current structure: $tableStructure\n";
    
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
    } else {
        echo "cover_letter column already exists\n";
    }
    
    // Show final table structure
    echo "\nFinal table structure:\n";
    $stmt = $pdo->query("PRAGMA table_info(applications)");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $column) {
        echo "- {$column['name']} ({$column['type']})\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "Done!\n";
?>
