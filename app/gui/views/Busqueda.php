<?php
    session_start();
    if($_SESSION['typeUser'] != "Cliente") {
        header("Location: ./../.");
        exit();
    }
    require_once '../controllers/BusquedaController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-search.css">
    <title>Búsqueda</title>
</head>
<body>
    <header>
        <h1>Lista de propiedades</h1>
    </header>
    <main>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
    </main>
</body>
</html>