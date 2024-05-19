<?php
require '/xampp/htdocs/inmobiliaria/inmobiliariaZAMATL/app/dataaccess/Connection.php';

class PropertyDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function insertProperty($property) {
        $query = "INSERT INTO Propiedad (idPropiedad, idAgente, idPropietario, ubicacion, nombre, numHabitaciones, medidasTerreno, estatus, descripcion, precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;
    
        if($statement = $mysqli->prepare($query)) {
            $idProperty = $property->getidProperty();
            $idAgent = $property->getidAgent();
            $idOwner = $property->getidOwner();
            $price = $property->getPrice();
            $ubication = $property->getubication();
            $name = $property->getname();
            $numberRooms = $property->getnumberRooms();
            $groundMeasurements = $property->getgroundMeasurements();
            $status = $property->getstatus();
            $description = $property->getdescription();
    
            $statement->bind_param("iiissidssd", $idProperty, $idAgent, $idOwner, $ubication, $name, $numberRooms, $groundMeasurements, $status, $description, $price);
            
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

    public function getPropertiesFromSearchCriteria($search) {
        $query = "SELECT * FROM Propiedad WHERE (precioRenta <= ? OR precioVenta <= ?) AND ubicacion = ? AND numHabitaciones = ?";
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        $precio = $search->getPrice();
        $ubicacion = $search->getUbication();
        $numHabitaciones = $search->getNumberRooms();
    
        $statement = $mysqli->prepare($query);
        $statement->bind_param("iiss", $precio, $precio, $ubicacion, $numHabitaciones);
        $statement->execute();
        $result = $statement->get_result();
    
        while($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
    
        $statement->close();
        $mysqli->close();
    
        return $properties;
    }
    

    public function getPropertiesFromClientPreferences($client) {
        $query = "SELECT * FROM Propiedad WHERE (precioRenta <= ? OR precioVenta <= ?) AND ubicacion = ? AND numHabitaciones = ?";
        $mysqli = $this->connection->getConnection();
        $properties = array();
    
        $preferredRentalPrice = $client->getPreferredRentalPrice();
        $preferredSellPrice = $client->getPreferredSellPrice();
        $preferredUbication = $client->getPreferredUbication();
        $preferredNumberRooms = $client->getPreferredNumberRooms();
    
        $statement = $mysqli->prepare($query);
        $statement->bind_param("iiss", $preferredRentalPrice, $preferredSellPrice, $preferredUbication, $preferredNumberRooms);
        $statement->execute();
        $result = $statement->get_result();
    
        while($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
    
        $statement->close();
        $mysqli->close();
    
        return $properties;
    }
    

    public function getMaxPrice() {
        $query = "SELECT GREATEST(MAX(precioRenta), MAX(precioVenta)) AS max_price FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $maxPrice = 0;
    
        $result = $mysqli->query($query);
    
        if ($row = $result->fetch_assoc()) {
            $maxPrice = $row['max_price'];
        }
    
        $mysqli->close();
    
        return $maxPrice;
    }
    

    public function getMaxRooms() {
        $query = "SELECT MAX(numHabitaciones) AS max_rooms FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $maxRooms = 0;
    
        $result = $mysqli->query($query);
    
        if ($row = $result->fetch_assoc()) {
            $maxRooms = $row['max_rooms'];
        }
    
        $mysqli->close();
    
        return $maxRooms;
    }
    

    public function getAllUbications() {
        $query = "SELECT DISTINCT ubicacion FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $ubications = array();

        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc()) {
            $ubications[] = $row['ubicacion'];
        }

        $mysqli->close();

        return $ubications;
    }


    public function getAllSizes() {
        $query = "SELECT DISTINCT medidasTerreno FROM Propiedad";
        $mysqli = $this->connection->getConnection();
        $sizes = array();
    
        $result = $mysqli->query($query);
    
        while($row = $result->fetch_assoc()) {
            $sizes[] = $row['medidasTerreno'];
        }
    
        $mysqli->close();
    
        return $sizes;
    }
    
    
}

?>