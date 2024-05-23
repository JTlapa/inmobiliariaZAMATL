<?php
session_start();
if ($_SESSION['typeUser'] != "Cliente") {
    header("Location: ./../.");
    exit();
}
require_once './../../logic/domain/User.php';
require_once './../../logic/domain/Client.php';
require_once './../../dataaccess/Connection.php';
require_once './../../logic/DAO/ClientDAO.php';

$typeAlert = $_POST['alerta'];
$id = $_SESSION['userId'];

$connection = new Connection();
$clientDAO = new ClientDAO($connection);

$result = $clientDAO->updateAlertType($id, $typeAlert);
if($result == 1){
    header('Location: ./../views/MenuPrincipalCliente.php');
}
?>