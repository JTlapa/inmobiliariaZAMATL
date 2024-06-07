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
}

?>
