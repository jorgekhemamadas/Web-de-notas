<?php
// Inicia la sesión
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION["username"])) {
    // Si no hay una sesión activa, redirige al usuario al formulario de inicio de sesión
    header("Location: index.php");
    exit;
}

// Manejar la lógica para cerrar sesión
if (isset($_POST["logout"])) {
    // Destruye la sesión
    session_unset();
    session_destroy();
    // Redirige al usuario al formulario de inicio de sesión
    header("Location: index.php");
    exit;
}

// Manejar la lógica para agregar y guardar notas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["title"], $_POST["note"])) {
        $title = trim($_POST["title"]);
        $noteContent = trim($_POST["note"]);

        // Verifica si el título y el contenido de la nota no están vacíos
        if (!empty($title) && !empty($noteContent)) {
            // Abre el archivo notas.txt en modo de escritura (añadir al final)
            $file = fopen("notas/notas.txt", "a");
            // Escribe el título y el contenido de la nota en el archivo
            fwrite($file, $title . PHP_EOL);
            fwrite($file, $noteContent . PHP_EOL);
            fwrite($file, PHP_EOL); // Agrega una línea en blanco para separar las notas
            // Cierra el archivo
            fclose($file);
        }
        // Redirige al usuario a la página de notas
        header("Location: notas.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notas</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-zFndTsFVS92uY2F0tTKTmzHx0BIq0W5zxurD4j5WUvPE5Q3kY4p3f8aOlW3ZO+n2" crossorigin="anonymous">
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #000;
    color: #fff;
  }
  
  #container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #222;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    position: relative;
  }
  
  h1 {
    text-align: center;
  }
  
  .logout-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
  }

  #add-note-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
  }

  #note-form {
    display: none;
  }

  #note-title,
  #note-content {
    width: calc(100% - 20px); /* Restar el padding de 10px a cada lado */
    padding: 10px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    background-color: #444;
    color: #fff;
    resize: none; /* Evitar redimensionamiento */
    overflow: hidden; /* Ocultar el desbordamiento */
    box-sizing: border-box; /* Incluir el padding en el cálculo del tamaño */
    word-wrap: break-word; /* Romper las palabras largas */
  }

  .save-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  .note {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #333;
    border-radius: 5px;
    position: relative;
    overflow-wrap: break-word;
    word-wrap: break-word;
  }

  .note-title {
    font-weight: bold;
    margin-bottom: 5px;
  }
</style>
</head>
<body>

<div id="container">
  <h3>Bienvenido a tus notas, <?php echo $_SESSION["username"]; ?></h3>
  <form action="" method="post">
    <button type="submit" name="logout" class="logout-btn">Cerrar Sesión</button>
  </form>

  <button id="add-note-btn">+</button>
  <form id="note-form" action="" method="post">
    <input type="text" id="note-title" name="title" placeholder="Título" required>
    <textarea id="note-content" name="note" placeholder="Escribe tu nota aquí" required></textarea>
    <button type="submit" class="save-btn">Guardar</button>
  </form>

  <div id="notes-container">
    <?php
    // Mostrar todas las notas guardadas
    $notesFile = "notas/notas.txt";
    if (file_exists($notesFile)) {
        $notes = array_reverse(file($notesFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        if (!empty($notes)) {
            $count = count($notes);
            for ($i = 0; $i < $count; $i += 2) {
                echo '<div class="note">';
                echo '<p class="note-title">' . htmlspecialchars($notes[$i+1]) . '</p>';
                echo '<p>' . htmlspecialchars($notes[$i]) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay notas disponibles para mostrar.</p>';
        }
    } else {
        echo '<p>No hay notas disponibles para mostrar.</p>';
    }
    ?>
  </div>
</div>

<script>
  document.getElementById("add-note-btn").addEventListener("click", function() {
    document.getElementById("note-form").style.display = "block";
  });
</script>

</body>
</html>
