<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Obtener la cantidad de facturas existentes
$sql = "SELECT COUNT(*) as total_facturas FROM facturar";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nro_fac = $row['total_facturas'] + 1;
} else {
    $nro_fac = 1;
}
// Obtener la fecha actual
$fecha_actual = date("Y-m-d");

// Obtener los nombres y las ide de los clientes
$sql = "SELECT ide_cli, nom_cli FROM clientes";
$result = $conexion->query($sql);
$clientes = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ide_cli = $row['ide_cli'];
        $clientes[$row['ide_cli']] = $row['nom_cli'];
    }
}
// Obtener los nombres y las ide de los vendedores
$sql = "SELECT ide_ven, nom_ven FROM vendedor";
$result = $conexion->query($sql);
$vendedores = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ide_ven = $row['ide_ven'];
        $vendedores[$row['ide_ven']] = $row['nom_ven'];
    }
}
// Obtener los nombres, las ide y los precios de los productos
$sql = "SELECT ide_pro, nom_pro, val_ven_pro, can_pro FROM productos";
$result = $conexion->query($sql);
$productos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[$row['ide_pro']] = array(
            'nombre' => $row['nom_pro'],
            'precio' => $row['val_ven_pro'],
            'stock' => $row['can_pro']
        );
    }
}
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $cliente = $_POST['cliente'];
    $vendedor = $_POST['vendedor'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $nom_pro = $productos[$producto]['nombre'];
    $val_ven_pro = $productos[$producto]['precio'];
    // Verificar si el producto seleccionado está disponible en stock
    if ($cantidad > $productos[$producto]['stock']) {
        echo "La cantidad seleccionada no está disponible en el stock.";
    } else {
        $newStock = $productos[$producto]['stock'] - $cantidad;
        $update = "UPDATE productos SET can_pro = $newStock WHERE ide_pro = '$producto'";
        if ($conexion 
        ->query($update) === TRUE) {}
        // Insertar la factura en la tabla "facturar"
        $sql = "INSERT INTO facturar (nro_fac, fec_fac, ide_cli, ide_ven, val_tot_fac) VALUES ('$nro_fac', '$fecha_actual', '$cliente', '$vendedor', 0)";
        if ($conexion
    ->query($sql) === TRUE) {
            // Crear el detalle de la factura en la tabla "detalles"
            $total = $cantidad * $productos[$producto]['precio'];
            $sql = "INSERT INTO detalles (nro_fac, ide_pro, cant_det, val_ind, val_tot) VALUES ('$nro_fac', '$producto', '$cantidad', '{$productos[$producto]["precio"]}', '$total')";
            if ($conexion
        ->query($sql) === TRUE) {
                // Calcular el valor total de la factura
                $sql = "UPDATE facturar SET val_tot_fac = (SELECT SUM(cant_det * val_ind) FROM detalles WHERE nro_fac = '$nro_fac') WHERE nro_fac = '$nro_fac'";
                if ($conexion
            ->query($sql) === TRUE) {
                echo "Factura creada correctamente.";
                } else {
                echo "Error al actualizar el valor total de la factura: " . $conexion
            ->error;
                }
            } else {
                echo "Error al crear el detalle de la factura: " . $conexion
            ->error;
            }
        } else {
            echo "Error al crear la factura: " . $conexion
        ->error;
        }
        // Obtener los datos de la factura
        $nro_fac = $nro_fac; // Obtener el número de factura desde donde sea necesario
        $ide_cli = $ide_cli; // Obtener el ID del cliente desde donde sea necesario
        $ide_ven = $ide_ven; // Obtener el ID del vendedor desde donde sea necesario
        $nom_pro = $nom_pro; // Obtener el nombre del producto desde donde sea necesario
        $val_ven_pro = $val_ven_pro; // Obtener el valor de venta del producto desde donde sea necesario
        $cantidad = $cantidad; // Obtener la cantidad desde donde sea necesario
        $val_tot_fac = $total; // Obtener el valor total de la factura desde donde sea necesario

        // Construir la URL con los parámetros de la factura
        $url = "showTicket.php?nro_fac=$nro_fac&ide_cli=$ide_cli&ide_ven=$ide_ven&nom_pro=$nom_pro&val_ven_pro=$val_ven_pro&cantidad=$cantidad&val_tot_fac=$val_tot_fac&fec_fac=$fecha_actual";

        // Redirigir al usuario a la página showTicket.php
        header("Location: $url");
        exit(); // Asegurarse de que no se ejecuten más líneas de código después de la redirección
    }
}    
$conexion->close();
?>

<!DOCTYPE html>
<html>
    <body>
    <h1>Crear Factura</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <table>
        <tr>
            <td><label for="cliente">Cliente:</label>
            <select name="cliente" id="cliente">
                <?php
                foreach ($clientes as $ide_cli => $nom_cli) {
                    echo "<option value='$ide_cli'>$nom_cli</option>";
                }
                ?>
            </select></td>
        </tr>
        <tr>
            <td><label for="vendedor">Vendedor:</label>
            <select name="vendedor" id="vendedor">
                <?php
                foreach ($vendedores as $ide_ven => $nom_ven) {
                    echo "<option value='$ide_ven'>$nom_ven</option>";
                }
                ?>
            </select></td>
        </tr>
        <tr>
            <td><label for="producto">Producto:</label>
            <select name="producto" id="producto">
                <?php
                foreach ($productos as $ide_pro => $producto) {
                    echo "<option value='$ide_pro' data-price='{$producto['precio']}' data-stock='{$producto['stock']}'>{$producto['nombre']}</option>";
                }
                ?>
            </select>

            <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad"></td>
        </tr>
            </table>
            <input type="submit" value="Crear Factura">
        </form> 
        <p><button><a href="../index.html">Volver</a></button></p>
    </body>
</html>
