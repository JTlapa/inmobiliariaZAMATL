<?php
    require './../../dataaccess/Connection.php';
    require './../../logic/DAO/PropertyDAO.php';

    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    if (isset($_GET['id'])) {
        $idProperty = $_GET['id'];
    }
    $newStatus = $_POST['comboTipo'];

    $connection = new Connection();
    $propertyDAO = new PropertyDAO($connection);

    $result = $propertyDAO->updateStatus($newStatus, $idProperty);
    if($result == 1) {
        header('Location: ./../views/MenuPrincipalAgente.php');
    }
?>