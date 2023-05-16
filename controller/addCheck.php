<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Verificar si se ha enviado un formulario de registro de factura
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nro_fac = $_POST["nro_fac"];
    $fec_fac = $_POST["fec_fac"];
    $val_tot_fac = $_POST["val_tot_fac"];
    $ide_cli = $_POST["ide_cli"];
    $ide_ven = $_POST["ide_ven"];

    // Preparar la consulta SQL para insertar una nueva factura
    $insert_query = "INSERT INTO facturar (nro_fac, fec_fac, val_tot_fac, ide_cli, ide_ven) 
                     VALUES ('$nro_fac', '$fec_fac', '$val_tot_fac', '$ide_cli', '$ide_ven')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_query)) {
        // Mostrar un mensaje de éxito si se insertó la factura correctamente
        echo "La factura se ha registrado correctamente.";
    } else {
        // Mostrar un mensaje de error si no se pudo insertar la factura
        echo "Error al registrar la factura: " . mysqli_error($conection);
    }
}
?>

<!DOCTYPE html>
<html>
    <body>
        <h2>Registrar nueva factura</h2>
        <form method="post">
            <label>Número de factura:</label>
            <input type="text" name="nro_fac"><br>
            <label>Fecha de factura:</label>
            <input type="text" name="fec_fac"><br>
            <label>Valor total de factura:</label>
            <input type="text" name="val_tot_fac"><br>
            <label>Id del cliente:</label>
            <input type="text" name="ide_cli"><br>
            <label>Id del vendedor:</label>
            <input type="text" name="ide_ven"><br>
            <input type="submit" value="Registrar">
        </form>
        <p><button><a href="../view/check.php">Facturas</a></button></p>
    </body>
</html>
