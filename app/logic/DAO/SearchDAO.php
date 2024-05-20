<?php

class SearchDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insertSearch($search) {
        $query = "INSERT INTO busqueda (idUsuario, precio, ubicacion, numHabitaciones, fecha, tipoBusqueda) VALUES (?, ?, ?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $idUser = $search->getIdUser();
            $price = $search->getPrice();
            $ubication = $search->getUbication();
            $numberRooms = $search->getNumberRooms();
            $date = $search->getDate();
            $searchType = $search->getSearchType();

            $statement->bind_param("idsiss", $idUser, $price, $ubication, $numberRooms, $date, $searchType);

            if($statement->execute()) {
                $result = $mysqli->insert_id;
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
