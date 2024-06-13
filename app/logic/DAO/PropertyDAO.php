<?php


class PropertyDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insertProperty($property) {
        $query = "INSERT INTO Propiedad (idAgente, idPropietario, ciudad, calle, numero, nombre, numHabitaciones, medidasTerreno, estatus, descripcion, precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;
    
        if ($statement = $mysqli->prepare($query)) {
            $idAgent = $property->getidAgent();
            $idOwner = $property->getidOwner();
            $price = $property->getPrice();
            $city = $property->getCity();
            $street = $property->getStreet();
            $number = $property->getNumber();
            $name = $property->getName();
            $numberRooms = $property->getNumberRooms();
            $groundMeasurements = $property->getGroundMeasurements();
            $status = $property->getStatus();
            $description = $property->getDescription();
    
            $statement->bind_param("iissisidssd", $idAgent, $idOwner, $city, $street, $number, $name, $numberRooms, $groundMeasurements, $status, $description, $price);
            
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
        $query = "UPDATE Propiedad SET ciudad = ?, calle = ?, numero = ?, nombre = ?, numHabitaciones = ?, descripcion = ?, medidasTerreno = ?, precio = ? WHERE idPropiedad = ?";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        $id = $property->getIdProperty();
        $city = $property->getCity();
        $street = $property->getStreet();
        $number = $property->getNumber();
        $nombre = $property->getName();
        $numHabitaciones = $property->getNumberRooms();
        $description = $property->getDescription();
        $medidasTerreno = $property->getGroundMeasurements();
        $precio = $property->getPrice();
        
        if ($statement = $mysqli->prepare($query)) {
    
            $statement->bind_param("ssisisddi", $city, $street, $number, $nombre, $numHabitaciones, $description, $medidasTerreno, $precio, $id);
            
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
                $property->setStreet($row['calle']);
                $property->setNumber($row['numero']);
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
        $precio = $search->getPrice();
        $ubicacion = $search->getUbication();
        $numHabitaciones = $search->getNumberRooms();
        $estatus = $search->getSearchType();
        $tamanio = $search->getTerrainMeasurement();
        
        if ($tamanio == 151) {
            $query = "SELECT * FROM Propiedad WHERE precio <= ? AND ciudad = ? AND numHabitaciones <= ? AND estatus = ? AND medidasTerreno >= ?";
        } else {
            $query = "SELECT * FROM Propiedad WHERE precio <= ? AND ciudad = ? AND numHabitaciones <= ? AND estatus = ? AND medidasTerreno <= ?";
        }
        
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("dsssd", $precio, $ubicacion, $numHabitaciones, $estatus, $tamanio);
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
        $preferredPrice = $client->getPreferredPrice();
        $preferredUbication = $client->getPreferredUbication();
        $preferredNumberRooms = $client->getPreferredNumberRooms();
        $preferredStatus = $client->getPreferredStatus();
        $groundMeasurements = $client->getGroundMeasurements();
        if ($groundMeasurements == 151) {
            $query = "SELECT * FROM Propiedad WHERE precio <= ? AND ciudad = ? AND numHabitaciones <= ? AND estatus = ? AND medidasTerreno >= ?";
        } else {
            $query = "SELECT * FROM Propiedad WHERE precio <= ? AND ciudad = ? AND numHabitaciones <= ? AND estatus = ? AND medidasTerreno <= ?";
        }
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("isssd", $preferredPrice, $preferredUbication, $preferredNumberRooms, $preferredStatus, $groundMeasurements);
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

    public function isNameRegistered($name) {
        $query = "SELECT COUNT(*) AS count FROM Propiedad WHERE nombre = ?";
        $mysqli = $this->connection->getConnection();
        $resultado = 0;
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("s", $name);
            $statement->execute();
            $result = $statement->get_result();
            
            while ($row = $result->fetch_assoc()) {
                if ($row['count'] > 0) {
                    $resultado = 1;
                }
            }
    
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $resultado;
    }
    
    public function isPropertyRegistered($city, $street, $number) {
        $query = "SELECT COUNT(*) AS count FROM Propiedad WHERE ciudad = ? AND calle = ? AND numero = ?";
        $mysqli = $this->connection->getConnection();
        $resultado = 0;

        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("ssi", $city, $street, $number);
            $statement->execute();
            $result = $statement->get_result();
            
            while ($row = $result->fetch_assoc()) {
                if ($row['count'] > 0) {
                    $resultado = 1;
                }
            }

            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }

        $mysqli->close();

        return $resultado;
    }

    public function getStatus($idProperty) {
        $query = "SELECT estatus FROM Propiedad WHERE idPropiedad = ?";
        $mysqli = $this->connection->getConnection();
        $status = null;
    
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("i", $idProperty);
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $status = $row['estatus'];
            }
    
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $status;
    }
}

?>
