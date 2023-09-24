<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=xjudge", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Handle database connection error
        echo "Database connection failed: " . $e->getMessage();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user data from the "users" table based on the username
    try {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $user['username'];
        echo $user['password'];

        if ($user && password_verify($password, password_hash($user['password'], PASSWORD_DEFAULT))) {
            // Password is correct, create a login session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Redirect to the dashboard or another protected page
            exit();
        } else {
       
            echo "Invalid username or password";
        }
    } catch (PDOException $e) {
     
        echo "Login failed: " . $e->getMessage();
    }
}
?>