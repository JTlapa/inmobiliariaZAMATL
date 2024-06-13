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
    <link rel="stylesheet" href="../styles/style-ranges.css">
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
                    <input type="text" name="nombre" id="nombre"  value="<?php echo $propertyLoaded->getName() ?>" required>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" required><?php echo $propertyLoaded->getDescription() ?></textarea>
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" value="<?php echo $propertyLoaded->getCity() ?>"  required>
                    <label for="calle">Calle</label>
                    <input type="text" name="calle" id="calle" value="<?php echo $propertyLoaded->getStreet() ?>" required>
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero"  value="<?php echo $propertyLoaded->getNumber() ?>" required>
                </aside>
                <div class="derecha">
                    <label for="sliderHabitaciones">No. de Habitaciones</label>
                    <input type="range" name="sliderHabitaciones" id="sliderHabitaciones" min="1" max="15" step="1" value="<?php echo $propertyLoaded->getNumberRooms() ?>" required>
                    <span class="slider-value" id="sliderHabitacionesValue"><?php echo $propertyLoaded->getNumberRooms() ?></span>
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
        var sliderTamanio = document.getElementById("sliderTamanio");
        var sliderTamanioValue = document.getElementById("sliderTamanioValue");
        var sliderPrecio = document.getElementById("sliderPrecio");
        var sliderPrecioValue = document.getElementById("sliderPrecioValue");
        var sliderHabitacion = document.getElementById("sliderHabitaciones");
        var sliderHabitacionesValue = document.getElementById("sliderHabitacionesValue");

        sliderTamanio.oninput = function() {
            sliderTamanioValue.innerHTML = this.value+"m&sup2;";
        };

        sliderPrecio.oninput = function() {
            sliderPrecioValue.textContent = "$"+this.value;
        };

        sliderHabitaciones.oninput = function() {
            sliderHabitacionesValue.textContent = this.value;
        };

    </script>
</body>
</html>
