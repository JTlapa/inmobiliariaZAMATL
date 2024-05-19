<?php
class SearchByProperty {
    private $idSearch = NULL;
    private $idProperty = NULL;

    public function getIdSearch() {
        return $this->idSearch;
    }

    public function setIdSearch($idSearch) {
        $this->idSearch = $idSearch;
    }

    public function getIdProperty() {
        return $this->idProperty;
    }

    public function setIdProperty($idProperty) {
        $this->idProperty = $idProperty;
    }
}
?>