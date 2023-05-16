<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Definir una variable para almacenar el mensaje de éxito
$mensaje = "";

// Verificar si se ha enviado un formulario de registro de lote
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $ide_lot = $_POST["ide_lot"];
    $fec_fab_lot = $_POST["fec_fab_lot"];
    $fec_ven_lot = $_POST["fec_ven_lot"];

    // Preparar la consulta SQL para insertar un nuevo lote
    $insert_query = "INSERT INTO lotes (ide_lot, fec_fab_lot, fec_ven_lot) VALUES ('$ide_lot', '$fec_fab_lot', '$fec_ven_lot')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_query)) {
        // Establecer el mensaje de éxito
        $mensaje = "El lote se ha registrado correctamente.";
    } else {
        // Mostrar un mensaje de error si no se pudo insertar el lote
        echo "Error al registrar el lote: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleaddclient.css">
    <link rel="icon" type="image/png" href="logopagina.png"/>
    <title>Registrar nuevo lote</title> <!-- Agrega el título deseado aquí -->
</head>
<body>
    <div class="formulario">
        <h1>Registrar nuevo lote</h1>
        <form method="post">
            <div class="username">
                <input type="text" name="ide_lot" required>
                <label>Id</label>
            </div>
            <div class="username">
                <input type="text" name="fec_fab_lot" required>
                <label>Fecha de fabricación</label>
            </div>
            <div class="username">
                <input type="text" name="fec_ven_lot" required>
                <label>Fecha de vencimiento</label>
            </div>
            <input type="submit" value="Registrar" class="registrar-button" id="registrar-btn" required>
            <div class="usuarios">
                <button><a href="../view/lots.php">Lotes</a></button>
            </div>
        </form>
        <div class="mensaje"><?php echo $mensaje; ?></div> <!-- Mostrar el mensaje de éxito -->
    </div>
</body>
</html>
