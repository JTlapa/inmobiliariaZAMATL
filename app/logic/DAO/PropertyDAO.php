<?php


class PropertyDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insertProperty($property) {
        $query = "INSERT INTO Propiedad (idAgente, idPropietario, ubicacion, nombre, numHabitaciones, medidasTerreno, estatus, descripcion, precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;
    
        if ($statement = $mysqli->prepare($query)) {
            $idAgent = $property->getidAgent();
            $idOwner = $property->getidOwner();
            $price = $property->getPrice();
            $ubication = $property->getUbication();
            $name = $property->getName();
            $numberRooms = $property->getNumberRooms();
            $groundMeasurements = $property->getGroundMeasurements();
            $status = $property->getStatus();
            $description = $property->getDescription();
    
            $statement->bind_param("iissidssd", $idAgent, $idOwner, $ubication, $name, $numberRooms, $groundMeasurements, $status, $description, $price);
            
            if ($statement->execute()) {
                $result = 1;
            } else {
                echo "Error: " . $mysqli->error;
            }
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
        $this->connection->closeConnection();
        return $result;
    }

    public function updateStatus($newStatus, $idProperty) {
        $query = "UPDATE Propiedad SET estatus = ? WHERE idPropiedad = ?";
        $mysqli = $this->connection->getConnection();
        $result = -1;
    
        if ($statement = $mysqli->prepare($query)) {
    
            $statement->bind_param("si", $newStatus, $idProperty);
            
            if ($statement->execute()) {
                $result = 1;
            } else {
                echo "Error: " . $mysqli->error;
            }
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
        $this->connection->closeConnection();
        return $result;
    }

    public function updatePropertyData($property) {
        $query = "UPDATE Propiedad SET ubicacion = ?, nombre = ?, numHabitaciones = ?, descripcion = ?, medidasTerreno = ?, precio = ? WHERE idPropiedad = ?";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        $id = $property->getIdProperty();
        $ubicacion = $property->getUbication();
        $nombre = $property->getName();
        $numHabitaciones = $property->getNumberRooms();
        $description = $property->getDescription();
        $medidasTerreno = $property->getGroundMeasurements();
        $precio = $property->getPrice();
        
        if ($statement = $mysqli->prepare($query)) {
    
            $statement->bind_param("ssisddi", $ubicacion, $nombre, $numHabitaciones, $description, $medidasTerreno, $precio, $id);
            
            if ($statement->execute()) {
                $result = 1;
            } else {
                echo "Error: " . $mysqli->error;
            }
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
        $this->connection->closeConnection();
        return $result;
    }

    public function getPropertyById($id) {
        $query = "SELECT * FROM Propiedad WHERE idPropiedad = ?";
        $mysqli = $this->connection->getConnection();
        $property = new Property();
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $property->setIdProperty($row['idPropiedad']);
                $property->setIdAgent($row['idAgente']);
                $property->setIdOwner($row['idPropietario']);
                $property->setPrice($row['precio']);
                $property->setCity($row['ciudad']);
                $property->setName($row['nombre']);
                $property->setNumberRooms($row['numHabitaciones']);
                $property->setGroundMeasurements($row['medidasTerreno']);
                $property->setStatus($row['estatus']);
                $property->setDescription($row['descripcion']);
            }
    
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $property;
    }

    public function getPropertiesFromSearchCriteria($search) {
        $query = "SELECT * FROM Propiedad WHERE precio <= ? AND ciudad = ? AND numHabitaciones <= ? AND estatus = ?";
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        $precio = $search->getPrice();
        $ubicacion = $search->getUbication();
        $numHabitaciones = $search->getNumberRooms();
        $estatus = $search->getSearchType();
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("dsss", $precio, $ubicacion, $numHabitaciones, $estatus);
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $property = new Property();
                $property->setIdProperty($row['idPropiedad']);
                $property->setIdAgent($row['idAgente']);
                $property->setIdOwner($row['idPropietario']);
                $property->setPrice($row['precio']);
                $property->setCity($row['ciudad']);
                $property->setStreet($row['calle']);
                $property->setNumber($row['numero']);
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
    

    public function getPropertiesFromClientPreferences($client) {
        $query = "SELECT * FROM Propiedad WHERE precio <= ? AND ciudad = ? AND numHabitaciones <= ? AND estatus = ?";
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        $preferredPrice = $client->getPreferredPrice();
        $preferredUbication = $client->getPreferredUbication();
        $preferredNumberRooms = $client->getPreferredNumberRooms();
        $preferredStatus = $client->getPreferredStatus();
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("isss", $preferredPrice, $preferredUbication, $preferredNumberRooms, $preferredStatus);
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $property = new Property();
                $property->setIdProperty($row['idPropiedad']);
                $property->setIdAgent($row['idAgente']);
                $property->setIdOwner($row['idPropietario']);
                $property->setPrice($row['precio']);
                $property->setCity($row['ciudad']);
                $property->setStreet($row['calle']);
                $property->setNumber($row['numero']);
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

    public function getAllProperties() {
        $query = "SELECT * FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $property = new Property();
                $property->setIdProperty($row['idPropiedad']);
                $property->setIdAgent($row['idAgente']);
                $property->setIdOwner($row['idPropietario']);
                $property->setPrice($row['precio']);
                $property->setCity($row['ciudad']);
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

    public function getMaxPrice() {
        $query = "SELECT MAX(precio) AS max_price FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $maxPrice = 0;
    
        if ($result = $mysqli->query($query)) {
            if ($row = $result->fetch_assoc()) {
                $maxPrice = $row['max_price'];
            }
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $maxPrice;
    }

    public function getMaxRooms() {
        $query = "SELECT MAX(numHabitaciones) AS max_rooms FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $maxRooms = 0;
    
        if ($result = $mysqli->query($query)) {
            if ($row = $result->fetch_assoc()) {
                $maxRooms = $row['max_rooms'];
            }
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $maxRooms;
    }

    public function getAllUbications() {
        $query = "SELECT DISTINCT ciudad FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $ubications = array();

        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $ubications[] = $row['ciudad'];
            }
        } else {
            echo "Error: " . $mysqli->error;
        }

        $mysqli->close();

        return $ubications;
    }

    public function getAllSizes() {
        $query = "SELECT DISTINCT medidasTerreno FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $sizes = array();
    
        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $sizes[] = $row['medidasTerreno'];
            }
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $sizes;
    }
}
?>
