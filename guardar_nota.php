<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["note"])) {
        $noteContent = $_POST["note"];
        $fileName = "notas/nota_" . date("YmdHis") . ".txt";
        file_put_contents($fileName, $noteContent);
        echo "Nota guardada exitosamente.";
    } else {
        echo "No se proporcionó contenido para la nota.";
    }
} else {
    echo "No se recibió una solicitud POST.";
}
?>
