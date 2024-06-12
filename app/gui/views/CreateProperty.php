<?php
session_start();
if($_SESSION['typeUser'] != "Agente") {
    header("Location: ./../.");
}

if (isset($_SESSION['error_message'])) {
    echo '<script> alert("'.$_SESSION['error_message'].'"); </script>';
    unset($_SESSION['error_message']);
}

$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
unset($_SESSION['form_data']);

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
                    <input type="text" name="nombre" id="nombre" value="<?php echo isset($form_data['nombre']) ? $form_data['nombre'] : ''; ?>" required>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" required><?php echo isset($form_data['descripcion']) ? $form_data['descripcion'] : ''; ?></textarea>
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" value="<?php echo isset($form_data['ciudad']) ? $form_data['ciudad'] : ''; ?>" required>
                    <label for="calle">Calle</label>
                    <input type="text" name="calle" id="calle" value="<?php echo isset($form_data['calle']) ? $form_data['calle'] : ''; ?>" required>
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero" value="<?php echo isset($form_data['numero']) ? $form_data['numero'] : ''; ?>" required>
                </aside>
                <div class="derecha">
                    <label for="sliderTamanio">Tamaño</label>
                    <input type="range" name="sliderTamanio" id="sliderTamanio" min="10" value="<?php echo isset($form_data['sliderTamanio']) ? $form_data['sliderTamanio'] : '10'; ?>" max="200" step="5" required>
                    <span class="slider-value" id="sliderTamanioValue"><?php echo isset($form_data['sliderTamanio']) ? $form_data['sliderTamanio'].'m&sup2;' : '10m&sup2;'; ?></span>
                    <label for="sliderHabitaciones">No. de Habitaciones</label>
                    <input type="range" name="sliderHabitaciones" id="sliderHabitaciones" min="1" value="<?php echo isset($form_data['sliderHabitaciones']) ? $form_data['sliderHabitaciones'] : '1'; ?>" max="15" step="1" required>
                    <span class="slider-value" id="sliderHabitacionesValue"><?php echo isset($form_data['sliderHabitaciones']) ? $form_data['sliderHabitaciones'] : '1'; ?></span>
                    <label for="sliderPrecio">Precio</label>
                    <input type="range" name="sliderPrecio" id="sliderPrecio" value="<?php echo isset($form_data['sliderPrecio']) ? $form_data['sliderPrecio'] : '1000'; ?>" min="1000" max="5000000" step="1000" required>
                    <span class="slider-value" id="sliderPrecioValue">$<?php echo isset($form_data['sliderPrecio']) ? $form_data['sliderPrecio'] : '1000'; ?></span>
                    <div class="selects">
                        <label for="comboTipo">Tipo de inmueble</label>
                        <select name="comboTipo" id="comboTipo">
                            <option value="" disabled <?php echo !isset($form_data['comboTipo']) ? 'selected' : ''; ?>>Selecciona un tipo</option>
                            <option value="Compra" <?php echo (isset($form_data['comboTipo']) && $form_data['comboTipo'] == 'Compra') ? 'selected' : ''; ?>>En venta</option>
                            <option value="Renta" <?php echo (isset($form_data['comboTipo']) && $form_data['comboTipo'] == 'Renta') ? 'selected' : ''; ?>>En renta</option>
                        </select>
                        <label for="comboPropietario">Propietario</label>
                        <select name="comboPropietario" id="comboPropietario">
                            <option value="" disabled <?php echo !isset($form_data['comboPropietario']) ? 'selected' : ''; ?>>Selecciona un Propietario</option>
                            <?php
                                $connection = new Connection();
                                $ownerDAO = new OwnerDAO($connection);
                                $owners = $ownerDAO->getOwners();
                                foreach ($owners as $owner) {
                                    $name = $owner->getName();
                                    $idUser = $owner->getUserId();
                                    $selected = (isset($form_data['comboPropietario']) && $form_data['comboPropietario'] == $idUser) ? 'selected' : '';
                                    echo "<option value='$idUser' $selected>$name</option>";
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
                sliderPrecio.step = 100000;
                sliderPrecio.value = 10000;
            } else if (tipo === 'Renta') {
                sliderPrecio.min = 1000;
                sliderPrecio.max = 50000;
                sliderPrecio.step = 1000;
                sliderPrecio.value = 1000;
            }

            sliderPrecioValue.textContent = `$${sliderPrecio.value}`;
        });
    </script>
</body>
</html>
