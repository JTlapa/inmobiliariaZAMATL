<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/login-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="login">
            <h1>Inicio de sesión</h1>
            <img src="images/logoFondoBlanco-removebg-preview.png" alt="Logo ZAMATL">
            <form action="controllers/loginController.php" method="post">
                <label for="usuario">Usuario</label>
                <input type="text" name="username" id="usuario">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
                <button type="submit">Iniciar sesión</button>
            </form>
            <p>¿No tienes cuenta? <a href="../gui/views/RegisterUser.php">Crea una</a></p>
        </div>
    </main>
</body>
</html>