<?php
try {
    // Test database connection
    $pdo = new PDO('sqlite:database/database.sqlite');
    echo "SQLite connection successful\n";
    
    // Check if applications table exists
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='applications'");
    if ($stmt->fetch()) {
        echo "Applications table exists\n";
        
        // Check table structure
        $stmt = $pdo->query("PRAGMA table_info(applications)");
        $columns = $stmt->fetchAll();
        echo "Applications table columns:\n";
        foreach ($columns as $column) {
            echo "- " . $column['name'] . " (" . $column['type'] . ")\n";
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
            echo "Adding cover_letter column...\n";
            $pdo->exec("ALTER TABLE applications ADD COLUMN cover_letter TEXT");
            echo "cover_letter column added successfully\n";
        } else {
            echo "cover_letter column already exists\n";
        }
    } else {
        echo "Applications table does not exist\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
