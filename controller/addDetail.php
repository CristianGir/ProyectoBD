<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Definir una variable para almacenar el mensaje de éxito
$mensaje = "";

// Verificar si se ha enviado un formulario de registro de detalle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nro_fac = $_POST["nro_fac"];
    $ide_pro = $_POST["ide_pro"];
    $cant_det = $_POST["cant_det"];
    $val_ind = $_POST["val_ind"];
    $val_tot = $cant_det * $val_ind;

    // Preparar la consulta SQL para insertar un nuevo detalle
    $insert_query = "INSERT INTO detalles (nro_fac, ide_pro, cant_det, val_ind, val_tot) VALUES ('$nro_fac', '$ide_pro', '$cant_det', '$val_ind', '$val_tot')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_query)) {
        // Establecer el mensaje de éxito
        $mensaje = "El detalle se ha registrado correctamente.";
    } else {
        // Mostrar un mensaje de error si no se pudo insertar el detalle
        echo "Error al registrar el detalle: " . mysqli_error($conexion);
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
    <title>Registrar nuevo detalle</title> <!-- Agrega el título deseado aquí -->
</head>
<body>
    <div class="formulario">
        <h1>Registrar nuevo detalle</h1>
        <form method="post">
            <div class="username">
                <input type="text" name="nro_fac" required>
                <label>Número de factura</label>
            </div>
            <div class="username">
                <input type="text" name="ide_pro" required>
                <label>Ide de producto</label>
            </div>
            <div class="username">
                <input type="text" name="cant_det" required>
                <label>Cantidad</label>
            </div>
            <div class="username">
                <input type="text" name="val_ind" required>
                <label>Valor individual</label>
            </div>
            <input type="submit" value="Registrar" class="registrar-button" id="registrar-btn" required>
            <div class="usuarios">
                <button><a href="../view/details.php">Detalles</a></button>
            </div>
        </form>
        <div class="mensaje"><?php echo $mensaje; ?></div> <!-- Mostrar el mensaje de éxito -->
    </div>
</body>
</html>
