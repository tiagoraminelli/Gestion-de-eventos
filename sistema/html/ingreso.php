<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
<form action="" method="post" class="login-form">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Iniciar sesión</button>
</form>

    <?php
    include 'footer.html'
    ?>
</body>
</html>
<style>
    body {
    font-family: serif;
}

.login-form {
    max-width: 300px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #dddddd;
    border-radius: 5px;
}

.login-form label {
    display: block;
    margin-bottom: 10px;
    color: #333333; /* Color de las etiquetas */
}

.login-form input[type="email"],
.login-form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #cccccc;
    border-radius: 3px;
    box-sizing: border-box;
}

.login-form button {
    width: 100%;
    padding: 10px;
    background-color: #007bff; /* Color de fondo del botón */
    border: none;
    color: #ffffff; /* Color del texto del botón */
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-form button:hover {
    background-color: #0056b3; /* Cambio de color al pasar el ratón por encima */
}

</style>