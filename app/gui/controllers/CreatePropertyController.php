<?php
session_start();
if ($_SESSION['typeUser'] != "Agente") {
    header("Location: ./../.");
    exit();
}

require_once './../../logic/domain/User.php';
require_once './../../dataaccess/Connection.php';
require_once '../../logic/domain/Property.php';
require_once '../../logic/DAO/PropertyDAO.php';
require_once '../../logic/DAO/UserDAO.php';

$connection = new Connection();
$propertyDAO = new PropertyDAO($connection);
$userDAO = new UserDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : null;
    $habitaciones = isset($_POST['habitaciones']) ? (int)$_POST['habitaciones'] : null;
    $ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : null;
    $tamanio = isset($_POST['tamanio']) ? (float)$_POST['tamanio'] : null;
    $tipo = isset($_POST['comboTipo']) ? $_POST['comboTipo'] : null;

    
    $property = new Property();
    $property->setIdAgent((int)$_SESSION['userId']);
    $property->setIdOwner(5);
    $property->setName($nombre);
    $property->setDescription($descripcion);
    $property->setStatus($tipo);
    $property->setNumberRooms($habitaciones);
    $property->setPrice($precio);
    $property->setUbication($ubicacion);
    $property->setGroundMeasurements($tamanio);
    $result = $propertyDAO->insertProperty($property);
    
    if($result==1) {
        $mails = $userDAO->getEmailsToAlert($ubicacion,$precio,$habitaciones);
        
        foreach($mails as $mail) {
            
            $to = $mail;
            $subject = 'Asunto del correo';
            $message = 'Este es el cuerpo del mensaje.';
            $headers = "MIME-Version=1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: coillogs4@gmail.com\r\n".
                    'Return-path:'.$mail.'' . "\r\n";
            mail($to, $subject, $message, $headers);
        }
        
        header("Location: ../views/MenuPrincipalAgente.php");
        exit();
    }

        
}
?>
