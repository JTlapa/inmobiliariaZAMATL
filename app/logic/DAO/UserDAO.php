<?php


class UserDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function getTypeUserById($id) {
        $query = "SELECT tipousuario FROM usuario where idUsuario= ?";
        $mysqli = $this->connection->getConnection();
        $result = "null";

        if($statement = $mysqli->prepare($query)) {
            $statement->bind_param("i", $id);
            $statement->execute();
            
            $statement->bind_result($typeUser);
            while ($statement->fetch()) {
                $result = $typeUser;
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