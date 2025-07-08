<?php
$dbPath = __DIR__ . '/database/database.sqlite';
echo "Creating SQLite database at: $dbPath\n";

try {
    // Create an empty SQLite database
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "SQLite database created successfully!\n";
    
    // Test the connection
    $result = $pdo->query('SELECT 1 as test');
    if ($result) {
        echo "Database connection test: SUCCESS\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
