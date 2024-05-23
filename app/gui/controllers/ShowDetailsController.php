<?php
    require './../../dataaccess/Connection.php';
    require './../../logic/domain/Property.php';
    require './../../logic/DAO/PropertyDAO.php';

    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    if (isset($_GET['id'])) {
        $idProperty = $_GET['id'];
    }
    $property = new Property();
    $property->setIdProperty($idProperty);
    $property->setName($_POST['nombre']);
    $property->setDescription($_POST['descripcion']);
    $property->setUbication($_POST['ubicacion']);
    $property->setNumberRooms((int)$_POST['habitaciones']);
    $property->setPrice((float)$_POST['precio']);
    $property->setGroundMeasurements((float)$_POST['tamanio']);

    $connection = new Connection();
    $propertyDAO = new PropertyDAO($connection);

    $result = $propertyDAO->updatePropertyData($property);
    if($result == 1) {
        header('Location: ./../views/MenuPrincipalAgente.php');
    }
?>