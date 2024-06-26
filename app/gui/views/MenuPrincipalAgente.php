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
require_once '../../logic/domain/Property.php';
require_once '../../logic/DAO/PropertyDAO.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-search.css">
    <link rel="stylesheet" href="../styles/styles-propertiesList.css">
    <title>Menu Principal</title>
</head>
<body>
    <header>
        <h1>Propiedades registradas</h1>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
    </header>
    <nav>
        <button onclick="newProperty()">Nueva propiedad</button>
        <button onclick="logOut()">Regresar</button>
    </nav>
    <main>
        
        <?php
            $connection = new Connection();
            $propertyDAO = new PropertyDAO($connection);
            $properties = $propertyDAO->getAllProperties();

            if (!empty($properties)) {
                foreach ($properties as $property) {
                    echo '<div class="property-panel">';
                    echo '<div><h2>' . htmlspecialchars($property->getName()) . '</h2>';
                    echo '<p><strong>Descripcion:</strong>' . htmlspecialchars($property->getDescription()) . '</p>';
                    echo '<p><strong>Ciudad:</strong> ' . htmlspecialchars($property->getCity()) . '</p>';
                    echo '<p><strong>Calle:</strong> ' . htmlspecialchars($property->getStreet()) . '</p>';
                    echo '<p><strong>Número: #</strong> '. htmlspecialchars($property->getNumber()) . '</p>';
                    echo '<p><strong>Tamaño:</strong> ' . htmlspecialchars($property->getGroundMeasurements()) . ' m²</p>';
                    echo '<p><strong>Habitaciones:</strong> ' . htmlspecialchars($property->getNumberRooms()) . '</p>';
                    echo '<p><strong>Está en: </strong>' . htmlspecialchars($property->getStatus()) . '</p>';
                    echo '<p class="price"><strong>Precio:</strong> $' . htmlspecialchars($property->getPrice()) . '</p> </div>';
                    echo '<div class="buttons"> <button onclick="showDetails('.$property->getIdProperty().')">Detalles</button>';
                    echo '<button onclick="showStatus('.$property->getIdProperty().')">Estatus</button>';
                    echo '</div></div>';
                }
            } else {
                echo '<p>No se encontraron propiedades.</p>';
            }
        ?>
    </main>
    <script>
        function logOut(){
            window.location.href = '../controllers/logout.php';
        }
        function newProperty() {
            window.location.href = 'CreateProperty.php';
        }
        function showDetails(idProperty) {
            window.location.href = "ShowDetails.php?id="+idProperty;
        }
        function showStatus(idProperty) {
            window.location.href = "ShowStatus.php?id="+idProperty;
        }
    </script>
</body>
</html>