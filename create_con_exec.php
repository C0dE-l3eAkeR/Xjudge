<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $contestName = $_POST['contestName'];
    $contestDuration = $_POST['contestDuration'];
    $contestStartTime = $_POST['contestStartTime'];
    $selectedProblems = $_POST['selectedProblems'];

    // Encode the selectedProblems array as a JSON string
    $selectedProblemsJSON = json_encode($selectedProblems);

    // Validate and sanitize the input data further as needed

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=xjudge", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Calculate the end time based on the duration and start time
        $startTimestamp = strtotime($contestStartTime);
        $endTimestamp = $startTimestamp + ($contestDuration * 3600); // Convert hours to seconds

        // Prepare and execute an SQL statement to insert the contest data
        $sql = "INSERT INTO contests (contestName, contestDuration, contestStartTime, selectedProblems) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$contestName, $contestDuration, $contestStartTime, $selectedProblemsJSON]);

        // Get the last inserted contest ID
        $contestId = $pdo->lastInsertId();

        // Redirect to the contest management page or display a success message
        header("Location: contests.php");
        exit();
    } catch (PDOException $e) {
        // Handle database error
        echo "Contest creation failed: " . $e->getMessage();
    }
}
?>