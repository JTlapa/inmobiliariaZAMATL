<?php
    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    
require_once './../../dataaccess/Connection.php';
require_once '../../logic/domain/User.php';
require_once '../../logic/domain/Owner.php';
require_once '../../logic/DAO/OwnerDAO.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-createProperty.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Registrar Propiedad</title>
</head>
<body>
    <header>
        <h1>Registro de Propiedad</h1>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
    </header>
    <main>
        <form action="../controllers/CreatePropertyController.php" method="post">
            <div class="form-content">
                <aside>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" required>
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" required>
                    <label for="ubicacion">Ubicacion</label>
                    <input type="text" name="ubicacion" id="ubicacion" required>
                </aside>
                <div class="derecha">
                    <label for="tamanio">Tamaño</label>
                    <input type="text" name="tamanio" id="tamanio" required>
                    <label for="habitaciones">No. de Habitaciones</label>
                    <input type="text" name="habitaciones" id="habitaciones" required>
                    <div class="selects">
                        <select name="comboTipo" id="comboTipo">
                            <option value="" disabled selected>Selecciona un tipo</option>
                            <option value="Compra">Compra</option>
                            <option value="Renta">Renta</option>
                        </select>
                        <select name="comboTipo" id="comboTipo">
                            <option value="" disabled selected>Selecciona un Propietario</option>
                            <?php
                                $connection = new Connection();
                                $ownerDAO = new OwnerDAO($connection);
                                $owners = $ownerDAO->getOwnersNames();
                                foreach ($owners as $owner) {
                                    echo "<option value='$owner'>$owner</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit">Registrar</button>
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
