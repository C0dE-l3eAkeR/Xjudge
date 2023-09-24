<?php
class User
{
    private $id;
    private $handle;
    private $name;
    private $email;
    private $problems_solved[];

    public function __construct($name, $email, $problems_solved, $handle)
    {
        $this->name = $name;
        $this->email = $email;
        $this->handle = $handle;
        $this->problems_solved = $problems_solved;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function toJSON()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'handle' => $this->handle,
            'problems_solved' => $this->problems_solved
        ]);
    }

    public function saveToDatabase(mysqli $mysqli)
    {
        $jsonUserData = $this->toJSON();
        $query = "INSERT INTO users (user_data) VALUES (?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $jsonUserData);
        $stmt->execute();
        $this->id = $mysqli->insert_id;
        $stmt->close();
    }
}
?>