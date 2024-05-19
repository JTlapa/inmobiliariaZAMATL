<?php

class AccountDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }
    public function insertAccount($account) {
        $query = "INSERT INTO CuentaAcceso VALUES(?, ?, sha2(?, 256))";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $id = $account->getUserId();
            $username = $account->getUser();
            $password = $account->getPassword();

            $statement->bind_param("iss", $id, $username, $password);
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
    public function getUserIdByAccount($account) {
        $query = "SELECT idUsuario FROM cuentaAcceso WHERE username = ? AND clave= sha2( ? , 256)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        $username = $account->getUser();
        $password = $account->getPassword();

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

?>