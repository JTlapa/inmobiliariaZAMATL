<?php

class Property {
    private $idProperty = NULL;
    private $idAgent = NULL;
    private $idOwner = NULL;
    private $price = NULL;
    private $city = NULL;
    private $street = NULL;
    private $number = NULL;
    private $name = NULL;
    private $numberRooms = NULL;
    private $groundMeasurements = NULL;
    private $status = NULL;
    private $description = NULL;

    public function getIdProperty() {
        return $this->idProperty;
    }

    public function setIdProperty($idProperty) {
        $this->idProperty = $idProperty;
    }

    public function getIdAgent() {
        return $this->idAgent;
    }

    public function setIdAgent($idAgent) {
        $this->idAgent = $idAgent;
    }

    public function getIdOwner() {
        return $this->idOwner;
    }

    public function setIdOwner($idOwner) {
        $this->idOwner = $idOwner;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getNumberRooms() {
        return $this->numberRooms;
    }

    public function setNumberRooms($numberRooms) {
        $this->numberRooms = $numberRooms;
    }

    public function getGroundMeasurements() {
        return $this->groundMeasurements;
    }

    public function setGroundMeasurements($groundMeasurements) {
        $this->groundMeasurements = $groundMeasurements;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function validateData() {
        $errors = null;
    
        // Validar city
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]+$/', $this->city) || strlen($this->city) > 60) {
            $errors = "El nombre de la ciudad debe contener solo letras y no exceder los 60 caracteres.";
            return $errors;
        }
    
        // Validar street
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]+$/', $this->street) || strlen($this->street) > 60) {
            $errors = "El nombre de la calle debe contener solo letras y no exceder los 60 caracteres.";
            return $errors;
        }
    
        // Validar number
        if (!is_numeric($this->number) || $this->number < 1 || $this->number >= 10000) {
            $errors = "El número de la propiedad debe ser un número mayor o igual a 1 y menor que 10000.";
            return $errors;
        }
    
        // Validar name
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]+$/', $this->name) || strlen($this->name) > 60) {
            $errors = "El nombre de la propiedad debe contener solo letras y no exceder los 60 caracteres.";
            return $errors;
        }
    
        // Validar description
        if (strlen($this->description) > 60) {
            $errors = "La descripción de la propiedad no debe exceder los 60 caracteres.";
            return $errors;
        }
        $connection = new Connection();
        $dao = new PropertyDAO($connection);
        if ($dao->isNameRegistered($this->name)) {
            $errors = "El nombre de la propiedad ya está registrado.";
            return $errors;
        }
        if ($dao->isPropertyRegistered($this->city, $this->street, $this->number)) {
            $errors = "La ubicación de la propiedad ya está ocupada por otra.";
            return $errors;
        }
    
        return $errors;
    }
    
}

?>
