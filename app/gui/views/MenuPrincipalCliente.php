<?php
    session_start();
    if($_SESSION['typeUser'] != "Cliente") {
        header("Location: ./../.");
        exit();
    }

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
</head>
<body>
    <header>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
        <div class="busqueda">
            <h1>¿Qué propiedad buscas?</h1>
            <label for="sliderPrecio">Precio máximo</label>
            <input type="range" name="sliderPrecio" id="sliderPrecio" value="0" max="<?php echo $maxPrice; ?>">
            <label for="sliderHabitacion">Habitaciones</label>
            <input type="range" name="sliderHabitacion" id="sliderHabitacion" value="0" max="<?php echo $maxRooms; ?>">
            <form action="../controllers/MenuClienteController.php" method="post">
                <nav>
                    <select name="comboubicacion" id="comboUbicacion">
                        <option value="" disabled selected>Selecciona una ubicación</option>
                        <?php
                        foreach ($ubicaciones as $ubicacion) {
                            ?>
                            <option value='<?php echo $ubicacion; ?>'><?php echo $ubicacion; ?></option>
                        <?php
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
                    <select name="comboAmenidades" id="comboAmenidades">
                        <option value="" disabled selected>Selecciona una amenidad</option>
                        <?php
                        foreach ($amenidades as $amenidad) {
                            echo "<option value='$amenidad'>$amenidad</option>";
                        }
                        ?>
                    </select>
                </nav>
            </form>
            <button type="submit">Buscar</button>
        </div>
    </header>
</body>
</html>