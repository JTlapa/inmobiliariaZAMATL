<?php
session_start();

require './../../dataaccess/Connection.php';
require '../../logic/domain/User.php';
require '../../logic/domain/Account.php';
require '../../logic/domain/Client.php';
require './../../logic/DAO/UserDAO.php';
require './../../logic/DAO/AccountDAO.php';
require './../../logic/DAO/ClientDAO.php';
require './../../logic/DAO/PropertyDAO.php';

$connection = new Connection();
$userDAO = new UserDAO($connection);
$accountDAO = new AccountDAO($connection);
$clientDAO = new ClientDAO($connection);
$propertyDAO = new PropertyDAO($connection);

$ubicaciones = $propertyDAO->getAllUbications();
$tamanios = $propertyDAO->getAllSizes();
$maxPrice = $propertyDAO->getMaxPrice();
$maxRooms = $propertyDAO->getMaxRooms();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $email = $_SESSION['correo'];
    $username = $_SESSION['usuario'];
    $password = $_SESSION['password'];

    $preferredUbication = $_POST['comboUbicacion'];
    $preferredNumberRooms = $_POST['sliderRooms'];
    $preferredPrice = $_POST['sliderPrice'];
    $preferredType = $_POST['typePreferences'];

    if($preferredPrice > 0 && $preferredNumberRooms > 0) {
        $user = new User();
        $user->setName($name);
        $user->setLastname($apellido);
        $user->setEmail($email);
        $user->setTypeUser('Cliente');
    
        $userId = $userDAO->insertUser($user);
    
        if ($userId != -1) {
            $account = new Account();
            $account->setUserId($userId);
            $account->setUser($username);
            $account->setPassword($password);
    
            $accountInsertResult = $accountDAO->insertAccount($account);
    
            if ($accountInsertResult == 1) {
                $client = new Client();
                $client->setUserID($userId);
                $client->setPreferredUbication($preferredUbication);
                $client->setPreferredNumberRooms($preferredNumberRooms);
                $client->setPreferredPrice($preferredPrice);
                $client->setPreferredStatus($preferredType);
    
                $clientInsertResult = $clientDAO->insertClient($client);
    
                if ($clientInsertResult == 1) {
                    echo "<script>alert('¡Cuenta creada exitosamente!\\nNombre de usuario: $username\\nContraseña: $password');";
                    echo "window.location.href = './../views/MenuPrincipalCliente.php';</script>";
                    exit();
                } else {
                    echo "Error al insertar cliente";
                }
            } else {
                echo "Error al insertar cuenta";
            }
        } else {
            echo "Error al insertar usuario";
        }
    } else {
        echo "<script>alert('Por favor, ingrese un precio y/o un número de habitaciones válidos.');</script>";
        header("Location: ./../views/UserPreferences.php");
        exit();
    }
}
?>
