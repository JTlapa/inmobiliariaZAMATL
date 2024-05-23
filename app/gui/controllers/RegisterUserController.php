<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $password = $_POST['password'];

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
