<?php


class UserDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }
    public function insertUser($user) {
        $query = "INSERT INTO Usuario(nombre, apellido, correo, tipoUsuario) VALUES(?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $name = $user->getName();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $typeUser = $user->getTypeUser();

            $statement->bind_param("ssss", $name, $lastname, $email, $typeUser);
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