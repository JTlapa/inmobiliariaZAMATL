<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-register.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Registrar usuario</title>
</head>
<body>
    <header>
        <h1>Registro de usuario</h1>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
    </header>
    <main>
        <form action="../controllers/RegisterUser.php" method="post">
            <div class="form-content">
                <aside>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                    <label for="apellido">Apellidos</label>
                    <input type="text" name="apellido" id="apellido" required>
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" required>
                </aside>
                <div class="derecha">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" required>
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" id="password" required>
                </div>
            </div>
            <div class="buttons">
                <button type="submit">Siguiente</button>
                <button type="button">Atrás</button>
            </div>
        </form>
    </main>
</body>
</html>
