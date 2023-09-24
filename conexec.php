<?php


class Contest {
    public $id;
    public $name;
    public $duration;
    public $startTime;
    public $endTime;

    public function __construct($id, $name, $duration, $startTime, $endTime) {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
}

function getContestsFromDatabase() {
    try {
        $pdo = new PDO("mysql:host=your_host;dbname=your_database", "your_username", "your_password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM contests";
        $stmt = $pdo->query($sql);
        $contestData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contests = [];
        foreach ($contestData as $data) {
            // Create contest objects and populate them
            $contest = new Contest(
                $data['id'],
                $data['name'],
                $data['duration'],
                $data['start_time'],
                $data['end_time']
            );
            $contests[] = $contest;
        }

        return $contests;
    } catch (PDOException $e) {
        // Handle database error
        echo "Failed to retrieve contests: " . $e->getMessage();
        return [];
    }
}


$contests = getContestsFromDatabase();


?>