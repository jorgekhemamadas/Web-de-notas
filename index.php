<?php
// Inicia la sesión
session_start();

// Verifica si hay una sesión activa
if (isset($_SESSION["username"])) {
    // Si hay una sesión activa, redirige al usuario a la página de notas
    header("Location: notas.php");
    exit;
}

// Resto del código de index.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>N o t a s</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #000;
    color: #fff;
  }

  #container {
    padding: 24px;
    border-radius: 6px;
    box-shadow: 0 0 16px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 400px;
  }

  h1 {
    margin-bottom: 20px;
    color: #0366d6;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    text-align: left;
    color: #fff;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="password"],
  button {
    padding: 10px;
    width: 100%;
    border: 1px solid #e1e4e8;
    border-radius: 6px;
    background-color: transparent;
    color: #fff;
    box-sizing: border-box;
  }

  button {
    cursor: pointer;
    background-color: #0366d6;
    color: #fff;
    border: none;
  }

  .error {
    color: #cb2431;
    margin-top: 10px;
  }

  .custom-logo {
    width: 80px;
    margin-bottom: 20px;
    background-color: transparent;
  }
</style>
</head>
<body>

<div id="container">
  <img src="icono.png.jpg" alt="Custom Logo" class="custom-logo">
  <h1>𝙸𝚗𝚒𝚌𝚒𝚊 𝚂𝚎𝚜𝚒ó𝚗 𝚎𝚗 𝙽𝚘𝚝𝚊𝚜</h1>

  <?php
  // Mostrar mensaje de error si existe
  if (isset($_GET["error"])) {
      $errorMessage = $_GET["error"];
      echo '<p class="error">' . $errorMessage . '</p>';
  }
  ?>

  <form action="validar_login.php" method="post">
    <div class="form-group">
      <label for="username">Usuario</label>
      <input type="text" id="username" name="username" placeholder="" required>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" placeholder="" required>
    </div>
    <button type="submit">Iniciar Sesión</button>
  </form>
</div>

</body>
</html>
