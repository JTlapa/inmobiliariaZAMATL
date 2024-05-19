<?php
class AgentDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }
    public function insertAgent($agent) {
        $query = "INSERT INTO Agente VALUES(?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $idUser = $agent->getUserId();

            $statement->bind_param("i", $idUser);
            if ($statement->execute()) {
                $result = 1;
            }
            $statement->close();
        } else {
            echo "Error";
        }

        $this->connection->closeConnection();
        return $result;
    }
}
?>