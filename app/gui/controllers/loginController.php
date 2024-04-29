<?php
session_start();

require_once './../../dataaccess/Connection.php';
require_once '../../logic/domain/User.php';
require_once './../../logic/DAO/UserDAO.php';

$username = $_POST["username"];
$password = $_POST['password'];

$user = new User();
$user->setUser($username);
$user->setPassword($password);

$userDAO = new UserDAO();
$userId = $userDAO->getUserIdByUser($user);

if($userId != -1) {
    $_SESSION['userId'] = $userId;
    $_SESSION['user'] = $username;
    header("Location: ./../views/MenuPrincipal.html"); 
}else {
    
    header("Location: ./../"); 
}
?>