<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style-register.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Registrar usuario</title>
</head>
<body>
    <header>
        <h1>Registro de usuario</h1>
        <img class="logo" src="../images/logoZAMATL-removebg-preview.png" alt="Logo ZAMATL">
    </header>
    <main>
        <?php
        session_start();
        if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>
        <form action="../controllers/RegisterUserController.php" method="post">
            <div class="form-content">
                <aside>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Juan" required>
                    <label for="apellido">Apellidos</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Hernández" required>
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" placeholder="example@domain.com" required>
                </aside>
                <div class="derecha">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" required>
                    <div class="password-wrapper">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Al menos 8 caracteres" required>
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit">Siguiente</button>
                <button type="button" onclick="window.history.back();">Atrás</button>
            </div>
        </form>
    </main>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
