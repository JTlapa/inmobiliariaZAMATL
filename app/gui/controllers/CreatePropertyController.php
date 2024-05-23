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
    $idPropietario = isset($_POST['comboPropietario']) ? (int)$_POST['comboPropietario'] : null;

    
    $property = new Property();
    $property->setIdAgent((int)$_SESSION['userId']);
    $property->setIdOwner($idPropietario);
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
            $subject = 'Nueva propiedad de tu interes';
            $message = "<html><body><p>Se ha agregado una nueva propiedadde tu interes: </p>";
            $message .= "<p>Nombre: ".$property->getName()."</p>";
            $message .= "<p>Descripcion: ".$property->getDescription()."</p>";
            $message .= "<p>Precio: ".$property->getPrice()."</p>";
            $message .= "<p>Ubicacion: ".$property->getUbication()."</p>";
            $message .= "<p>Estatus: ".$property->getStatus()."</p>";
            $message .= "<p>Numero de habitaciones: ".$property->getNumberRooms()."</p>";
            $message .= "</body></html>";
            
            $headers = "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= 'From: coillogs4@gmail.com' . "\r\n" .
            'Reply-To: '.$mail. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            mail($to, $subject, $message, $headers);
        }

        header("Location: ../views/MenuPrincipalAgente.php");
        exit();
    }

        
}
?>
<html>
    <body>
        <p></p>
    </body>
</html>