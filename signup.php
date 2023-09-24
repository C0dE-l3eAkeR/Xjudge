<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation code (same as in the previous code)

    
     
        // Assign values from the POST data
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password =   $_POST["password"];
        $repeat_password = $_POST["reppassword"];
        $flag = 1;
        // Validate username
        if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            echo '<script>alert("Failed")</script>';
        }

        // Validate password
        if ($password !== $repeat_password) {
            echo '<script>alert("Failed")</script>';
            $flag =0;
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Failed")</script>';
            $flag =0;
        }

        // If all validations pass, insert data into the database
    if ($flag==1) {
        $db_host = "localhost";  // Database host (change if needed)
        $db_user = "root";       // Database username
        $db_pass = "";           // Database password (leave empty if not set)
        $db_name = "xjudge";  // Database name

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=xjudge", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $hashedPassword]);
    
            // Registration successful, you can redirect to a success page
           
           echo '<script>alert("Success")</script>';

           sleep(3);
           header("Location: login.html");
            exit();
        } catch (PDOException $e) {
            // Handle database errors, e.g., duplicate email
            echo '<script>alert("Failed")</script>';
        }
}
}
?>