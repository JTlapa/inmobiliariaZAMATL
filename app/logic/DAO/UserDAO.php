<?php

class UserDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function getUserIdByUser($user) {
        $query = "SELECT idUsuario FROM usuario WHERE usuario = ? AND clave= sha2( ? , 256)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        $username = $user->getUser();
        $password = $user->getPassword();

        if($statement = $mysqli->prepare($query)) {
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
            
            $statement->bind_result($idUsuario);
            while ($statement->fetch()) {
                $result = $idUsuario;
            }
            $statement->close();
        } else {
            echo "Error";
        }

        $this->connection->closeConnection();
        return $result;
    }
}
/*
$user = new User();

$user->setUser("zamatl");
$user->setPassword("password123");

$userDAO = new UserDAO();
echo $userDAO->getUserIdByUser($user);
*/
?>