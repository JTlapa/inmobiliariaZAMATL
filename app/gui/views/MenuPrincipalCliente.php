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
    </style>
</head>
<body>
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
    </script>
</body>
</html>
