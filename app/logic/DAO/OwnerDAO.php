<?php
class OwnerDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct($connection) {
        $this->connection = $connection;
    }
    public function insertOwner($owner) {
        $query = "INSERT INTO Propietario VALUES(?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $idUser = $owner->getUserId();

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

    public function getOwners() {
        $query = "SELECT propietario.idUsuario as id, nombre FROM usuario INNER JOIN propietario WHERE usuario.idUsuario = propietario.idUsuario";
        $mysqli = $this->connection->getConnection();
        $owners = array();
        
        if ($statement = $mysqli->prepare($query)) {
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $owner = new Owner();
                $owner->setName($row['nombre']);
                $owner->setUserId($row['id']);
                $owners[] = $owner;
            }
    
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $owners;
    }
}
?>