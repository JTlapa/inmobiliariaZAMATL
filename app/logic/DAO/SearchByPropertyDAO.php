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
    public function getPropertiesByIdSearch($idSearch) {
        $query = "select DISTINCT propiedad.idPropiedad as idPropiedad,nombre, ubicacion, numHabitaciones, precio," ;
        $query .= "medidasTerreno, estatus, descripcion from propiedad inner join busquedaporpropiedad on ";
        $query .= "busquedaporpropiedad.idPropiedad = propiedad.idPropiedad WHERE busquedaporpropiedad.idBusqueda = ?";
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("i", $idSearch);
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $property = new Property();
                $property->setPrice($row['precio']);
                $property->setUbication($row['ubicacion']);
                $property->setName($row['nombre']);
                $property->setNumberRooms($row['numHabitaciones']);
                $property->setGroundMeasurements($row['medidasTerreno']);
                $property->setStatus($row['estatus']);
                $property->setDescription($row['descripcion']);
    
                $properties[] = $property;
            }
    
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $properties;
    }
}
?>
