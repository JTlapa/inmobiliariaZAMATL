<?php
    require_once '../controllers/UserPreferencesController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-preferences.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Preferencias usuario</title>
    <style>
        .slider-value {
            color: white;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>¿Qué propiedades te interesan?</h1>
        <img src="../images/logoZAMATL-removebg-preview.png" alt="LOGO ZAMATL">
    </header>
    <main>
        <form action="../controllers/UserPreferencesController.php" method="post">
            <nav class="comboPreferences">
                <select name="comboUbicacion" id="comboUbicacion" required>
                    <option value="" disabled selected>Seleccione una ciudad</option>
                    <?php
                        foreach($ubicaciones as $ubicacion) {
                            echo "<option value='$ubicacion'>$ubicacion</option>";
                        }
                    ?>
                </select>
                <select name="comboTamanio" id="comboTamanio" required>
                    <option value="" disabled selected>Selecciona un tamaño del terreno</option>
                    <option value="50">Menos de 50 m²</option>
                    <option value="75">Entre 51 y 75 m²</option>
                    <option value="80">Más de 80 m²</option>
                </select>
            </nav>
            <nav class="sliders">
                <label for="sliderPrecio">Precio máximo</label>
                <input type="range" name="sliderPrice" id="sliderPrecio" value="0" max="<?php echo $maxPrice; ?>" step="5000" required>
                <span class="slider-value" id="sliderPrecioValue">0</span>
                <h2>Características especiales</h2>
                <label for="sliderHabitaciones">Habitaciones</label>
                <input type="range" name="sliderRooms" id="sliderHabitacion" value="0" max="<?php echo $maxRooms; ?>" step="1" required>
                <span class="slider-value" id="sliderHabitacionValue">0</span>
            </nav>
            <nav class="radio">
                <label for="radioTypeCompra">Compra</label>
                <input type="radio" name="typePreferences" id="radioTypeCompra" value="Compra" required>
                <label for="radioTypeRenta">Renta</label>
                <input type="radio" name="typePreferences" id="radioTypeRenta" value="Renta" required>
            </nav>
            <nav class="buttons">
                <button type="submit">Registrarme</button>
                <button type="button" onclick="window.history.back();">Cancelar</button>
            </nav>
        </form>
    </main>
    <script>
        var sliderPrecio = document.getElementById("sliderPrecio");
        var sliderPrecioValue = document.getElementById("sliderPrecioValue");
        var sliderHabitacion = document.getElementById("sliderHabitacion");
        var sliderHabitacionValue = document.getElementById("sliderHabitacionValue");

        sliderPrecio.oninput = function() {
            sliderPrecioValue.textContent = "$"+this.value;
        };

        sliderHabitacion.oninput = function() {
            sliderHabitacionValue.textContent = this.value;
        };
    </script>
</body>
</html>
