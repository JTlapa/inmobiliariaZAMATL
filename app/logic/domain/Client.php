<?php

class Client extends User {
    private $preferredStatus = NULL;
    private $preferredPrice = NULL;
    private $preferredUbication = NULL;
    private $preferredNumberRooms = NULL;
    private $groundMeasurements = NULL;

    public function getPreferredStatus() {
        return $this->preferredStatus;
    }

    public function setPreferredStatus($status) {
        $this->preferredStatus = $status;
    }

    public function getPreferredPrice() {
        return $this->preferredPrice;
    }

    public function setPreferredPrice($preferredPrice) {
        $this->preferredPrice = $preferredPrice;
    }

    public function getPreferredUbication() {
        return $this->preferredUbication;
    }

    public function setPreferredUbication($preferredUbication) {
        $this->preferredUbication = $preferredUbication;
    }

    public function getPreferredNumberRooms() {
        return $this->preferredNumberRooms;
    }

    public function setPreferredNumberRooms($preferredNumberRooms) {
        $this->preferredNumberRooms = $preferredNumberRooms;
    }

    public function getGroundMeasurements() {
        return $this->groundMeasurements;
    }

    public function setGroundMeasurements($groundMeasurements) {
        $this->groundMeasurements = $groundMeasurements;
    }
}
?>