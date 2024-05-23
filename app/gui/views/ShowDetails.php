<?php
    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    
    if (isset($_GET['id'])) {
        $idProperty = $_GET['id'];
    }
    require_once './../../dataaccess/Connection.php';
    require_once './../../logic/domain/Property.php';
    require_once './../../logic/DAO/PropertyDAO.php';

    $connection = new Connection();
    $propertyDAO = new PropertyDAO($connection);
    $propertyLoaded = $propertyDAO->getPropertyById($idProperty);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-createProperty.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Actualizar Propiedad</title>
</head>
<body>
    <header>
        <h1>Actualizar Propiedad</h1>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
    </header>
    <main>
        <form action="../controllers/ShowDetailsController.php?id=<?php echo $idProperty;?>"  method="post">
            <div class="form-content">
                <aside>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $propertyLoaded->getName() ?>" required>
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" value="<?php echo $propertyLoaded->getDescription() ?>" required>
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" value="<?php echo $propertyLoaded->getPrice() ?>" required>
                </aside>
                <div class="derecha">
                    <label for="tamanio">Tamaño</label>
                    <input type="text" name="tamanio" id="tamanio" value="<?php echo $propertyLoaded->getGroundMeasurements() ?>" required>
                    <label for="habitaciones">No. de Habitaciones</label>
                    <input type="text" name="habitaciones" id="habitaciones" value="<?php echo $propertyLoaded->getNumberRooms() ?>" required>
                    <label for="ubicacion">Ubicacion</label>
                    <input type="text" name="ubicacion" id="ubicacion" value="<?php echo $propertyLoaded->getUbication() ?>" required>
                </div>
            </div>
            <div class="buttons">
                <button type="submit">Guardar</button>
                <button type="button" onclick="logOut()">Atrás</button>
            </div>
        </form>
    </main>
    <script>
        function logOut(){
            window.location.href = './MenuPrincipalAgente.php';
        }
    </script>
</body>
</html>
