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
    $precio = isset($_POST['sliderPrecio']) ? (float)$_POST['sliderPrecio'] : null;
    $habitaciones = isset($_POST['sliderHabitaciones']) ? (int)$_POST['sliderHabitaciones'] : null;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
    $calle = isset($_POST['calle']) ? $_POST['calle'] : null;
    $numero = isset($_POST['numero']) ? (int)$_POST['numero'] : null;
    $tamanio = isset($_POST['sliderTamanio']) ? (float)$_POST['sliderTamanio'] : null;
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
    $property->setCity($ciudad);
    $property->setStreet($calle);
    $property->setNumber($numero);
    $property->setGroundMeasurements($tamanio);

    $errors = $property->validateData();
    if($errors != null) {
        $_SESSION['error_message'] = "'.$errors.'";
        header("Location: ../views/CreateProperty.php");
        exit();
    }
    else {
        $result = $propertyDAO->insertProperty($property);
        
        if($result==1) {
            echo '<script>alert("Se ha registrado con éxito la propiedad '.$nombre.'");</script>';
            $_SESSION['error_message'] = "Se ha registrado con éxito la propiedad '.$nombre.'";
            $mails = $userDAO->getEmailsToAlert($ciudad,$precio,$habitaciones);
            
            foreach($mails as $mail) {
                $to = $mail;
                $subject = 'Nueva propiedad de tu interes';
                $message = "<html><body><p>Se ha agregado una nueva propiedadde tu interes: </p>";
                $message .= "<p>Nombre: ".$property->getName()."</p>";
                $message .= "<p>Descripcion: ".$property->getDescription()."</p>";
                $message .= "<p>Precio: ".$property->getPrice()."</p>";
                $message .= "<p>Ubicacion: ".$property->getCity()."</p>";
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
        
}
?>
<html>
    <body>
        <p></p>
    </body>
</html>