<?php
// Verifica si se enviaron datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificar la autenticación (aquí puedes usar cualquier lógica de validación)
    if ($username === "jorge" && $password === "000") {
        // Inicio de sesión exitoso
        // Inicia la sesión
        session_start();
        // Almacena el nombre de usuario en la sesión
        $_SESSION["username"] = $username;
        
        // Redirigir al usuario a la página deseada
        header("Location: notas.php");
        exit;
    } else {
        // Credenciales incorrectas
        // Mostrar un mensaje de error
        $errorMessage = "Error de usuario";
        // Redirigir al usuario al formulario de inicio de sesión
        header("Location: index.php?error=" . urlencode($errorMessage));
        exit;
    }
} else {
    // Si no se envió una solicitud POST, redirigir al formulario de inicio de sesión
    header("Location: index.php");
    exit;
}
?>
