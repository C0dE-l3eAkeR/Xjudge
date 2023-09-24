<?php
try {
    $pdo = new PDO("mysql:host=your_host;dbname=your_database", "your_username", "your_password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve problem data from the "problems" table
    $sql = "SELECT * FROM problems";
    $stmt = $pdo->query($sql);
    $problems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}
?>