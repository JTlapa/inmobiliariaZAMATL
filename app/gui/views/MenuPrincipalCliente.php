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
        .clientButtons {
            position: fixed;
            z-index: 1;
            width: 200px;
            margin: 0 calc(100% - 200px) 0;
        }
        .clientButton {
            background-color: #cea12c;
        }
        .clientButton:hover {
            opacity: 0.9;
        }
        .clientButton:last-child {
            background-color: red;
        }

        .rangos {
            display: block;
        }

        .rangos label {
            display: block;
        }

        .rangos select {
            width: 210px;
        }
    </style>
</head>
<body>
    <div class="clientButtons">
        <button class="clientButton" onclick="displayHistory()">Historial</button>
        <button class="clientButton" onclick="displayAlerts()">Alertas</button>
    </div>
    <header>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
        <div class="busqueda">
            <h1>¿Qué propiedad buscas?</h1>
            <form action="../controllers/MenuClienteController.php" method="post">
                <div class="selections">
                    <div class="rangos">
                        <label for="priceRange">Rango de precios</label>
                        <select name="priceRange" id="priceRange">
                            <option value="" disabled selected>Seleccione un rango de precios</option>
                        </select>
                    </div>
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
                        <option value="50">Menos de 50m²</option>
                        <option value="50 - 100">Entre 50 y 100 m²</option>
                        <option value="100 - 150">Entre 100 y 150 m²</option>
                        <option value="150 - 300">Entre 150 y 300 m²</option>
                        <option value="300 - 500">Entre 300 y 500 m²</option>
                        <option value="500 - 1000">Entre 500 y 1000 m²</option>
                        <option value="1000 - 5000">Entre 1000 y 5000 m²</option>
                        <option value="5000 - 10000">Entre 5000 y 10000 m²</option>
                        <option value="10000">Más de 10000 m²</option>
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
            if (!empty($properties)) {
                foreach ($properties as $property) {
                    echo '<div class="property-panel">';
                    echo '<h2>' . htmlspecialchars($property->getName()) . '</h2>';
                    echo '<p><strong>Descripción: </strong>' . htmlspecialchars($property->getDescription()) . '</p>';
                    echo '<p><strong>Ciudad:</strong> ' . htmlspecialchars($property->getCity()) . '</p>';
                    echo '<p><strong>Calle:</strong> ' . htmlspecialchars($property->getStreet()) . '</p>';
                    echo '<p><strong>Número: #</strong> ' . htmlspecialchars($property->getNumber()) . '</p>';
                    echo '<p><strong>Tamaño:</strong> ' . htmlspecialchars($property->getGroundMeasurements()) . ' m²</p>';
                    echo '<p><strong>Habitaciones:</strong> ' . htmlspecialchars($property->getNumberRooms()) . '</p>';
                    echo '<p><strong>Está en: </strong>' . htmlspecialchars($property->getStatus()) . '</p>';
                    echo '<p class="price"><strong>Precio:</strong> $' . htmlspecialchars($property->getPrice()) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p class="no-properties">No hay propiedades que vayan de acuerdo a tus preferencias</p>';
            }
            ?>
        </div>
    </div>
    <button id="logoutButton" class="logoutButton" onclick="logout()">Log Out</button>
</main>
    <script>
        function logout() {
            window.location.href = '../controllers/logout.php';
        }
        var sliderHabitacion = document.getElementById("sliderHabitacion");
        var sliderHabitacionValue = document.getElementById("sliderHabitacionValue");
        var maxSellPrice = <?php echo json_encode($maxSellPrice); ?>;
        var maxRentalPrice = <?php echo json_encode($maxRentalPrice); ?>;

        sliderHabitacion.oninput = function() {
            sliderHabitacionValue.textContent = this.value;
        };

        function displayAlerts() {
            window.location.href = 'Alerts.php';
        }

        function displayHistory() {
            window.location.href = 'History.php';
        }

        function generatePriceRanges(maxPrice, step) {
            var priceRanges = [];
            for (var i = 0; i <= maxPrice; i += step) {
                var end = i + step - 1;
                if (end >= maxPrice) {
                    priceRanges.push("$" + i + " o más");
                    break;
                } else {
                    priceRanges.push("$" + i + " - $" + end);
                }
            }
            return priceRanges;
        }

        document.querySelectorAll('input[name="searchType"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var tipo = this.value;
                var comboPrecio = document.getElementById('priceRange');
                var step = tipo === 'Compra' ? 500000 : 1000;

                comboPrecio.innerHTML = '<option value="" disabled selected>Seleccione un rango de precios</option>';

                if (tipo === 'Compra') {
                    var priceRanges = generatePriceRanges(maxSellPrice, step);
                    priceRanges.forEach(function(range) {
                        var option = document.createElement('option');
                        option.value = range;
                        option.text = range;
                        comboPrecio.add(option);
                    });
                } else if (tipo === 'Renta') {
                    var priceRanges = generatePriceRanges(maxRentalPrice, step);
                    priceRanges.forEach(function(range) {
                        var option = document.createElement('option');
                        option.value = range;
                        option.text = range;
                        comboPrecio.add(option);
                    });
                }
            });
        });
    </script>
</body>
</html>
