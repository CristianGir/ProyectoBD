<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Obtener los parámetros de la factura
$nro_fac = $_GET['nro_fac'];
$ide_cli = $_GET['ide_cli'];
$ide_ven = $_GET['ide_ven'];
$nom_pro = $_GET['nom_pro'];
$val_ven_pro = $_GET['val_ven_pro'];
$cantidad = $_GET['cantidad'];
$val_tot_fac = $_GET['val_tot_fac'];
$fec_fac = $_GET['fec_fac'];
 
// Obtener el nombre del cliente
$sql = "SELECT nom_cli FROM clientes WHERE ide_cli = '$ide_cli'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nom_cli = $row['nom_cli'];
}

// Obtener el nombre del vendedor
$sql = "SELECT nom_ven FROM vendedor WHERE ide_ven = '$ide_ven'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nom_ven = $row['nom_ven'];
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Factura</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Farma Zelda</h1>
    <table>
        <tr>
            <th>Número de Factura</th>
            <td><?php echo $nro_fac; ?></td>
        </tr>
        <tr>
            <th>Cliente</th>
            <td><?php echo $nom_cli . " - " . $ide_cli; ?></td>
        </tr>
        <tr>
            <th>Vendedor</th>
            <td><?php echo $nom_ven . " - " . $ide_ven; ?></td>
        </tr>
        <tr>
            <th>Producto</th>
            <td><?php echo $nom_pro; ?></td>
        </tr>
        <tr>
            <th>Precio Unitario</th>
            <td><?php echo $val_ven_pro; ?></td>
        </tr>
        <tr>
            <th>Cantidad</th>
            <td><?php echo $cantidad; ?></td>
        </tr>
        <tr>
            <th>Valor Total</th>
            <td><?php echo $val_tot_fac; ?></td>
        </tr>
    </table>
    <p><button><a href="../index.html">Volver</a></button></p>
</body>
</html>
