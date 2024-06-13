<?php
    session_start();
    if($_SESSION['typeUser'] != "Agente") {
        header("Location: ./../.");
    }
    if (isset($_GET['id'])) {
        $idProperty = $_GET['id'];
    }
    include "./../../dataaccess/Connection.php";
    include "./../../logic/DAO/PropertyDAO.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar estatus</title>
    <link rel="stylesheet" href="./../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-search.css">
    <link rel="stylesheet" href="../styles/styles-propertiesList.css">
    <link rel="stylesheet" href="../styles/style-register.css">
    <style>
        form {
            margin: 100px auto 0;
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
            width: 50%;
        }
        form select, .price-container {
            width: 50%;
            margin: 10px 0;
            display: flex;
            align-items: center;
        }
        button {
            margin: 20px auto;
        }
        select, input {
            border-radius: 5px;
            height: 35px;
        }
        .price-container {
            display: none;
        }
        .price-container input {
            width: calc(100% - 20px); /* Adjust width to fit the container */
            margin-left: 10px; /* Add space between the $ symbol and input */
        }
        .error-message {
            color: red;
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
        $connection = new Connection();
        $propertyDAO = new PropertyDAO($connection);
        $previusStatus = $propertyDAO->getStatus($idProperty);
    ?>
    <form id="statusForm" action="./../controllers/ShowStatus.Controller.php?id=<?php echo $idProperty;?>" method="post">
        <label for="comboTipo">Selecciona el nuevo estatus de la propiedad</label>
        <select name="comboTipo" id="comboTipo" required>
            <?php
                if($previusStatus == "Compra") {
                    echo '<option value="Compra" disable option>En venta</option>';
                    echo '<option value="Renta">En renta</option>';
                }
                elseif($previusStatus == "Renta") {
                    echo '<option value="Renta" disable option>En renta</option>';
                    echo '<option value="Compra">En venta</option>';
                }
            ?>
        </select>
        <div class="price-container" id="priceContainer">
            <label for="priceInput">$</label>
            <input type="text" id="priceInput" name="newPrice" placeholder="Ingrese el nuevo precio">
        </div>
        <div class="error-message" id="errorMessage">El precio debe ser mayor o igual a 1000.</div>
        <button type="submit">Guardar</button>
        <button type="button" onclick="previusMenu()">Atrás</button>
    </form>
</body>

<script>
    document.getElementById('comboTipo').addEventListener('change', function() {
        const previousStatus = "<?php echo $previusStatus; ?>";
        const selectedStatus = this.value;
        const priceContainer = document.getElementById('priceContainer');
        const priceInput = document.getElementById('priceInput');

        if (previousStatus !== selectedStatus) {
            priceContainer.style.display = 'flex';
            priceInput.required = true;
        } else {
            priceContainer.style.display = 'none';
            priceInput.required = false;
        }
    });

    document.getElementById('priceInput').addEventListener('input', function(e) {
        const input = e.target;
        input.value = input.value
            .replace(/[^0-9.]/g, '') // Remove non-numeric and non-dot characters
            .replace(/(\..*?)\..*/g, '$1') // Allow only one dot
            .replace(/^0+(\d)/, '$1'); // Remove leading zeros

        const parts = input.value.split('.');
        if (parts.length > 1 && parts[1].length > 2) {
            input.value = parts[0] + '.' + parts[1].slice(0, 2);
        }
    });

    document.getElementById('statusForm').addEventListener('submit', function(e) {
        const priceInput = document.getElementById('priceInput');
        const errorMessage = document.getElementById('errorMessage');

        if (priceInput.required && parseFloat(priceInput.value) < 1000) {
            e.preventDefault();
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    });

    function previusMenu() {
        window.location.href = './MenuPrincipalAgente.php';
    }
</script>
</html>
