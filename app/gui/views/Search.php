<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-search.css">
    <title>Búsqueda</title>
</head>
<body>
    <header>
        <h1>Lista de propiedades</h1>
    </header>
    <main>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
        <div class="property-list">
            <?php
            require_once '../controllers/SearchController.php';
            $properties = isset($_GET['properties']) ? unserialize(urldecode($_GET['properties'])) : [];

            if (!empty($properties)) {
                foreach ($properties as $property) {
                    echo '<div class="property-panel">';
                    echo '<h2>' . htmlspecialchars($property->getName()) . '</h2>';
                    echo '<p><strong>Descripcion:</strong>' . htmlspecialchars($property->getDescription()) . '</p>';
                    echo '<p><strong>Ciudad:</strong> ' . htmlspecialchars($property->getCity()) . '</p>';
                    echo '<p><strong>Calle:</strong> ' . htmlspecialchars($property->getStreet()) . '</p>';
                    echo '<p><strong>Número: #</strong> '. htmlspecialchars($property->getNumber()) . '</p>';
                    echo '<p><strong>Tamaño:</strong> ' . htmlspecialchars($property->getGroundMeasurements()) . ' m²</p>';
                    echo '<p><strong>Habitaciones:</strong> ' . htmlspecialchars($property->getNumberRooms()) . '</p>';
                    echo '<p><strong>Está en: </strong>' . htmlspecialchars($property->getStatus()) . '</p>';
                    echo '<p class="price"><strong>Precio:</strong> $' . htmlspecialchars($property->getPrice()) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No se encontraron propiedades.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <button onclick="window.history.back();">Ir a Menú Principal</button>
    </footer>
</body>
</html>
