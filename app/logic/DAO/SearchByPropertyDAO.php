<?php

class SearchByPropertyDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insertSearchByProperty($searchByProperty) {
        $query = "INSERT INTO busquedaporpropiedad (idBusqueda, idPropiedad) VALUES (?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $idSearch = $searchByProperty->getIdSearch();
            $idProperty = $searchByProperty->getIdProperty();

            $statement->bind_param("ii", $idSearch, $idProperty);

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
