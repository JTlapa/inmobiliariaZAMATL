<?php
require '../../logic/DAO/PropertyDAO.php';


$propertyDAO = new PropertyDAO();

$ubicaciones = $propertyDAO->getAllUbications();
$tamanios = $propertyDAO->getAllSizes();
#$amenidades = $propertyDAO->getAllAmenities();

$maxPrice = $propertyDAO->getMaxPrice();
$maxRooms = $propertyDAO->getMaxRooms();
    header('Location: ../views/Busqueda.php');
?>