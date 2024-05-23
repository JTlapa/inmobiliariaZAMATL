<?php
    require_once '../controllers/MenuClienteController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-home.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Menu Principal</title>
    <style>
        .slider-value {
            color: white;
            display: block;
            margin-top: 10px;
        }
        .clientButtons{
            position: fixed;
            z-index: 1;
            width: 200px;
            margin: 0 calc(100% - 200px) 0;
        }
        .clientButton{
            background-color: #cea12c;
        }
        .clientButton:hover{
            opacity: 0.9;
        }
        .clientButton:last-child{
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="clientButtons">
        <button class="clientButton" onclick="displayHistpry()">Historial</button>
        <button class="clientButton" onclick="displayAlerts()">Alertas</button>
    </div>
    <header>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
        <div class="busqueda">
            <h1>¿Qué propiedad buscas?</h1>
            <form action="../controllers/MenuClienteController.php" method="post">
                <div class="selections">
                    <label for="sliderPrecio">Precio máximo</label>
                    <input type="range" name="sliderPrice" id="sliderPrecio" value="0" max="<?php echo $maxPrice; ?>" step="10000">
                    <span class="slider-value" id="sliderPrecioValue">0</span>
                    <label for="sliderHabitacion">Habitaciones</label>
                    <input type="range" name="sliderRooms" id="sliderHabitacion" value="0" max="<?php echo $maxRooms; ?>" step="1">
                    <span class="slider-value" id="sliderHabitacionValue">0</span>
                    <div class="radio">
                        <label for="radioTypeCompra">Compra</label>
                        <input type="radio" name="searchType" id="radioTypeCompra" value="Compra">
                        <label for="radioTypeRenta">Renta</label>
                        <input type="radio" name="searchType" id="radioTypeRenta" value="Renta">
                    </div>
                </div>
                <nav>
                    <select name="comboUbicacion" id="comboUbicacion">
                        <option value="" disabled selected>Selecciona una ubicación</option>
                        <?php
                        foreach ($ubicaciones as $ubicacion) {
                            echo "<option value='$ubicacion'>$ubicacion</option>";
                        }
                        ?>
                    </select>
                    <select name="comboTamanio" id="comboTamanio">
                        <option value="" disabled selected>Selecciona un tamaño</option>
                        <?php
                        foreach ($tamanios as $tamanio) {
                            echo "<option value='$tamanio'>$tamanio</option>";
                        }
                        ?>
                    </select>
                </nav>
                <button type="submit">Buscar</button>
            </form>
        </div>
    </header>
    <main>
    <div class="property-container">
        <h1>Propiedades recomendadas</h1>
        <div class="property-list">
            <?php
            foreach ($properties as $property) {
                echo '<div class="property-panel">';
                echo '<h2>' . htmlspecialchars($property->getName()) . '</h2>';
                echo '<p><strong>Descripcion:</strong>' . htmlspecialchars($property->getDescription()) . '</p>';
                echo '<p><strong>Ubicación:</strong> ' . htmlspecialchars($property->getUbication()) . '</p>';
                echo '<p><strong>Tamaño:</strong> ' . htmlspecialchars($property->getGroundMeasurements()) . ' m²</p>';
                echo '<p><strong>Habitaciones:</strong> ' . htmlspecialchars($property->getNumberRooms()) . '</p>';
                echo '<p><strong>Está en: </strong>' . htmlspecialchars($property->getStatus()) . '</p>';
                echo '<p class="price"><strong>Precio:</strong> $' . htmlspecialchars($property->getPrice()) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</main>

    <script>
        var sliderPrecio = document.getElementById("sliderPrecio");
        var sliderPrecioValue = document.getElementById("sliderPrecioValue");
        var sliderHabitacion = document.getElementById("sliderHabitacion");
        var sliderHabitacionValue = document.getElementById("sliderHabitacionValue");

        sliderPrecio.oninput = function() {
            sliderPrecioValue.textContent = this.value;
        };

        sliderHabitacion.oninput = function() {
            sliderHabitacionValue.textContent = this.value;
        };
        function displayAlerts(){
            window.location.href = 'Alerts.php';
        }
        function displayHistory() {
            window.location.href = 'History.php';
        }
    </script>
</body>
</html>
