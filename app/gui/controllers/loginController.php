<?php

require './../../dataaccess/Connection.php';
require '../../logic/domain/Account.php';
require './../../logic/DAO/AccountDAO.php';
require '../../logic/domain/User.php';
require './../../logic/DAO/UserDAO.php';

$username = $_POST["username"];
$password = $_POST['password'];

$account = new Account();
$account->setUser($username);
$account->setPassword($password);

$connection = new Connection();
$accountDAO = new AccountDAO($connection);
$userId = $accountDAO->getUserIdByAccount($account);
$userDAO = new UserDAO();

if($userId != -1) {
    $typeUser = $userDAO->getTypeUserById($userId);

    session_start();
    $_SESSION['typeUser'] = $typeUser;
    $_SESSION['userId'] = $userId;
    if($typeUser == "Cliente") {
        header("Location: ./../views/MenuPrincipalCliente.php"); 
    } elseif ($typeUser == "Agente") {
        header("Location: ./../views/MenuPrincipalAgente.php"); 
    }
} else {
    session_start();
    $_SESSION['error_message'] = "La cuenta no existe. Verifica tus credenciales.";
    echo "<script>window.location.href = './../';</script>";
}
?>