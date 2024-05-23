<?php
session_start();
if ($_SESSION['typeUser'] != "Cliente") {
    header("Location: ./../.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas</title>
    <link rel="stylesheet" href="./../styles/reset.css">
    <link rel="stylesheet" href="./../styles/style-register.css">
    <link rel="stylesheet" href="./../styles/style-home.css">
    <style>
        main{
            margin: 100px auto;
            width: 80%;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }
        main form {
            margin: 50px auto;
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }
        main form button {
            margin: 50px 0;
        }
    </style>
</head>
<body>
    <main>
        <h1>Configuracion de alertas</h1>
        <form action="./../controllers/AlertsController.php" method="post">
            <select name="alerta" id="alerta" required>
                <option value="" disabled selected>Selecciona una opcion</option>
                <option value="Ubicacion">Ubicación</option>
                <option value="Precio">Precio</option>
                <option value="Habitaciones">Número de habitaciones</option>
            </select>
            <button type="submit">Guardar</button>
        </form>
    </main>
</body>
</html>