<?php
class Search {
    private $idSearch = NULL;
    private $idUser = NULL;
    private $price = NULL;
    private $ubication = NULL;
    private $numberRooms = NULL;
    private $date = NULL;
    private $searchType = NULL;
    private $terrainMeasurement = NULL;

    public function getIdSearch() {
        return $this->idSearch;
    }

    public function setIdSearch($idSearch) {
        $this->idSearch = $idSearch;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getUbication() {
        return $this->ubication;
    }

    public function setUbication($ubication) {
        $this->ubication = $ubication;
    }

    public function getNumberRooms() {
        return $this->numberRooms;
    }

    public function setNumberRooms($numberRooms) {
        $this->numberRooms = $numberRooms;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getSearchType() {
        return $this->searchType;
    }

    public function setSearchType($searchType) {
        $this->searchType = $searchType;
    }

    public function getTerrainMeasurement() {
        return $this->terrainMeasurement;
    }

    public function setTerrainMeasurement($terrainMeasurement) {
        $this->terrainMeasurement = $terrainMeasurement;
    }
}


?>