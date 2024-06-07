<?php
class UserDAO {
    private $connection = NULL;
    private $mysqli = NULL;

    public function __construct() {
        $this->connection = new Connection();
    }
    public function insertUser($user) {
        $query = "INSERT INTO Usuario(nombre, apellido, correo, tipoUsuario) VALUES(?, ?, ?, ?)";
        $mysqli = $this->connection->getConnection();
        $result = -1;

        if($statement = $mysqli->prepare($query)) {
            $name = $user->getName();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $typeUser = $user->getTypeUser();

            $statement->bind_param("ssss", $name, $lastname, $email, $typeUser);
            if ($statement->execute()) {
                $result = $mysqli->insert_id;
            }
            $statement->close();
        } else {
            echo "Error";
        }

        $this->connection->closeConnection();
        return $result;
    }
    public function getTypeUserById($id) {
        $query = "SELECT tipousuario FROM usuario where idUsuario= ?";
        $mysqli = $this->connection->getConnection();
        $result = "null";

        if($statement = $mysqli->prepare($query)) {
            $statement->bind_param("i", $id);
            $statement->execute();
            
            $statement->bind_result($typeUser);
            while ($statement->fetch()) {
                $result = $typeUser;
            }
            $statement->close();
        } else {
            echo "Error";
        }

        $this->connection->closeConnection();
        return $result;
    }
    public function getEmailsToAlert($location, $price, $rooms){
        $query = "(SELECT correo, nombre from usuario inner join cliente on cliente.idUsuario=usuario.idUsuario where tipoAlerta='Ubicacion' and ubicacionPref= ?) union (select correo, nombre from usuario inner join cliente on cliente.idUsuario=usuario.idUsuario where tipoAlerta='Habitaciones' and numHabitacionesPref>= ?) union (select correo, nombre from usuario inner join cliente on cliente.idUsuario=usuario.idUsuario where tipoAlerta='Precio' and precioPref>= ?)";
        $mysqli = $this->connection->getConnection();
        $emails = array();
        
        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("sid", $location, $rooms, $price);
            $statement->execute();
            $result = $statement->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $email = $row['correo'];
                $emails[] = $email;
            }
    
            $statement->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    
        $mysqli->close();
    
        return $emails;
    }

    public function isEmailRegistered($email) {
        $query = "SELECT correo FROM usuario WHERE correo = ?";
        $mysqli = $this->connection->getConnection();
        $result = false;

        if ($statement = $mysqli->prepare($query)) {
            $statement->bind_param("s", $email);
            $statement->execute();
            $statement->store_result();
            $count = $statement->num_rows;
            $result = $count > 0;
            $statement->close();
        }

        $this->connection->closeConnection();
        return $result;
    }
}

?>