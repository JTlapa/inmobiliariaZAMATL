<?php

class ClientDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insertClient($client) {
        $query = "INSERT INTO Cliente (idUsuario, ubicacionPref, numHabitacionesPref, precioPref, estatusPref)VALUES (?, ?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $idUser = $client->getUserId();
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

    public function updateAlertType($id, $typeAlert) {
        $query = "UPDATE Cliente SET tipoAlerta = ? WHERE idUsuario = ?";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {

            $statement->bind_param("si", $typeAlert, $id);
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

    public function getClienteById($idClient) {
        $query = "SELECT * FROM Cliente WHERE idUsuario = ?";
        $mysqli = $this->connection->getConnection();
        $client = new Client;

        if($statement = $mysqli->prepare($query)) {
            $statement->bind_param("i", $idClient);
            $statement->execute();
            $result = $statement->get_result();

            while($row = $result->fetch_assoc()) {
                $client->setUserId($row['idUsuario']);
                $client->setPreferredUbication($row['ubicacionPref']);
                $client->setPreferredNumberRooms($row['numHabitacionesPref']);
                $client->setPreferredPrice($row['precioPref']);
                $client->setPreferredStatus($row['estatusPref']);
                $client->setGroundMeasurements($row['medidasTerreno']);
            }

            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }

        $mysqli->close();
        return $client;
    }
}
?>