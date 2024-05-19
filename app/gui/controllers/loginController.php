<?php
session_start();

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

$accountDAO = new AccountDAO();
$userId = $accountDAO->getUserIdByAccount($account);
$userDAO = new UserDAO();

echo($userId);

if($userId != -1) {
    $typeUser = $userDAO->getTypeUserById($userId);

    $_SESSION['typeUser'] = $typeUser;
    $_SESSION['userId'] = $userId;
    if($typeUser == "Cliente") {
        header("Location: ./../views/MenuPrincipalCliente.php"); 
    } elseif ($typeUser == "Agente") {
        header("Location: ./../views/MenuPrincipalAgente.php"); 
    }
    
}else {
    
    header("Location: ./../"); 
}
?>