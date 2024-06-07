<?php
session_start();

require_once '../../logic/DAO/AccountDAO.php';
require_once '../../logic/DAO/UserDAO.php';
require_once '../../dataaccess/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $password = $_POST['password'];

    $connection = new Connection();
    $accountDAO = new AccountDAO($connection);
    $userDAO = new UserDAO();

    if (strlen($password) < 8) {
        $_SESSION['error_message'] = "La contraseña debe tener al menos 8 caracteres.";
        header("Location: /inmobiliaria/inmobiliariaZAMATL/app/gui/views/RegisterUser.php");
        exit();
    }
    
    if($userDAO->isEmailRegistered($email)) {
        $_SESSION['error_message'] = "El correo ya está registrado. Por favor, usa otro correo";
        header("Location: /inmobiliaria/inmobiliariaZAMATL/app/gui/views/RegisterUser.php");
        exit();
    }

    if($accountDAO->isUsernameRegistered($user)) {
        $_SESSION['error_message'] = "El nombre de usuario ya está en uso. Por favor, elige otro nombre de usuario.";
        header("Location: /inmobiliaria/inmobiliariaZAMATL/app/gui/views/RegisterUser.php");
        exit();
    }

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $name)) {
        $_SESSION['error_message'] = "Nombre inválido. Solo se permiten letras y espacios.";
    } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
        $_SESSION['error_message'] = "Apellido inválido. Solo se permiten letras y espacios.";
    } else {
        $_SESSION['nombre'] = $name;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['correo'] = $email;
        $_SESSION['usuario'] = $user;
        $_SESSION['password'] = $password;

        header("Location: /inmobiliaria/inmobiliariaZAMATL/app/gui/views/UserPreferences.php");
        exit();
    }

    header("Location: /inmobiliaria/inmobiliariaZAMATL/app/gui/views/RegisterUser.php");
}
?>
