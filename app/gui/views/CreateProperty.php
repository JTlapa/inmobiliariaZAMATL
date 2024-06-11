<?php
    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    if (isset($_SESSION['error_message'])) {
        echo '<script> alert("'.$_SESSION['error_message'].'"); </script>';
        unset($_SESSION['error_message']);
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
    <link rel="stylesheet" href="../styles/style-ranges.css">
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
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" required>
                    <label for="calle">Calle</label>
                    <input type="text" name="calle" id="calle" required>
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero" required>
                </aside>
                <div class="derecha">
                    <label for="sliderTamanio">Tamaño</label>
                    <input type="range" name="sliderTamanio" id="sliderTamanio" min="10" value="10" max="200" step="5" required>
                    <span class="slider-value" id="sliderTamanioValue">10m&sup2;</span>
                    <label for="sliderHabitaciones">No. de Habitaciones</label>
                    <input type="range" name="sliderHabitaciones" id="sliderHabitaciones" min="1" value="1" max="15" step="1" required>
                    <span class="slider-value" id="sliderHabitacionesValue">1</span>
                    <label for="sliderPrecio">Precio</label>
                    <input type="range" name="sliderPrecio" id="sliderPrecio" value="1000" min="1000" max="5000000" step="100" required>
                    <span class="slider-value" id="sliderPrecioValue">$1000</span>
                    <div class="selects">
                    <label for="comboTipo">Tipo de inmueble</label>
                        <select name="comboTipo" id="comboTipo">
                            <option value="" disabled selected>Selecciona un tipo</option>
                            <option value="Compra">En venta</option>
                            <option value="Renta">En renta</option>
                        </select>
                        <label for="comboPropietario">Propietario</label>
                        <select name="comboPropietario" id="comboPropietario">
                            <option value="" disabled selected>Selecciona un Propietario</option>
                            <?php
                                $connection = new Connection();
                                $ownerDAO = new OwnerDAO($connection);
                                $owners = $ownerDAO->getOwners();
                                foreach ($owners as $owner) {
                                    $name = $owner->getName();
                                    $idUser = $owner->getUserId();
                                    echo "<option value='$idUser'>$name</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit">Continuar</button>
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

        document.getElementById('comboTipo').addEventListener('change', function() {
            var tipo = this.value;
            var sliderPrecio = document.getElementById('sliderPrecio');
            var sliderPrecioValue = document.getElementById('sliderPrecioValue');

            if (tipo === 'Compra') {
                sliderPrecio.min = 10000;
                sliderPrecio.max = 5000000;
                sliderPrecio.step = 1000;
                sliderPrecio.value = 10000;
            } else if (tipo === 'Renta') {
                sliderPrecio.min = 1000;
                sliderPrecio.max = 50000;
                sliderPrecio.step = 100;
                sliderPrecio.value = 1000;
            }

            sliderPrecioValue.textContent = `$${sliderPrecio.value}`;
        });
    </script>
</body>
</html>
