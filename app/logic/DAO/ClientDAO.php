<?php
require '/xampp/htdocs/inmobiliaria/inmobiliariaZAMATL/app/dataaccess/Connection.php';

class ClientDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function insertClient($client) {
        $query = "INSERT INTO Cliente VALUES (?, ?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $idUser = $client->getIdUser();
            $preferredUbication = $client->getPreferredUbication();
            $preferredNumberRooms = $client->getPreferredNumberRooms();
            $preferredPrice = $client->getPreferredPrice();
            $preferredStatus = $client->getPreferredStatus();

            $statement->bind_param("isids", $idUser, $preferredUbication, $preferredNumberRooms, $preferredPrice, $preferredStatus);
            if($statement->execute()) {
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