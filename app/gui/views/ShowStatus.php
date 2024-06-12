<?php
    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    if (isset($_GET['id'])) {
        $idProperty = $_GET['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar estatus</title>
    <link rel="stylesheet" href="./../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-search.css">
    <link rel="stylesheet" href="../styles/styles-propertiesList.css">
    <link rel="stylesheet" href="../styles/style-register.css">
    <style>
        form {
            margin: 100px auto 0;
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
            width: 50%;
        }
        form select {
            width: 50%;
            margin: 50px 0 150px;
        }
        button {
            margin: 0 auto;
        }
        select {
            border-radius: 5px;
            height: 35px;
        }
    </style>
</head>
<body>
    <form action="./../controllers/ShowStatus.Controller.php?id=<?php echo $idProperty;?>" method="post">
        <select name="comboTipo" id="comboTipo" required>
            <option value="" disabled selected>Selecciona un tipo</option>
            <option value="Compra">Compra</option>
            <option value="Renta">Renta</option>
            <option value="Ocupado">Ocupado</option>
        </select>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>