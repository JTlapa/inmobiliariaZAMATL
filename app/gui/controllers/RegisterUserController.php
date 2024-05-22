<?php


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $password = $_POST['password'];

    header("Location: /inmobiliaria/inmobiliariaZAMATL/app/gui/views/UserPreferences.php");
    exit();
}
?>