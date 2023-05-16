<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Verificar si se ha enviado un formulario de registro de producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $ide_pro = $_POST["ide_pro"];
    $nom_prod = $_POST["nom_prod"];
    $val_ven_pro = $_POST["val_ven_pro"];
    $can_pro = $_POST["can_pro"];
    $val_com_pro = $_POST["val_com_pro"];
    $ide_cat = $_POST["ide_cat"];
    $ide_lot = $_POST["ide_lot"];
    //Datos de proveedor
    $nit_pro = $_POST["nit_pro"];
    $nom_prov = $_POST["nom_prov"];
    $tel_pro = $_POST["tel_pro"];

    // Preparar la consulta SQL para insertar un nuevo producto
    if (!empty($val_ven_pro) && is_numeric($val_ven_pro)) {
        // Preparar la consulta SQL para insertar un nuevo producto
        $insert_prod_query = "INSERT INTO productos (ide_pro, nom_pro, val_ven_pro, can_pro, val_com_pro, ide_cat, ide_lot) VALUES ('$ide_pro', '$nom_prod', '$val_ven_pro', '$can_pro', '$val_com_pro', '$ide_cat', '$ide_lot')";
    }
        $insert_prov_query = "INSERT INTO proveedores (nit_pro, nom_pro, tel_pro) VALUES ('$nit_pro', '$nom_prov', '$tel_pro')";
    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_prod_query) && mysqli_query($conexion, $insert_prov_query)) {
        // Obtener el id del último producto insertado
        $last_id = mysqli_insert_id($conexion);

        // Preparar la consulta SQL para insertar un nuevo registro en la tabla prod_prov
        $insert_prod_prov_query = "INSERT INTO prod_prov (ide_pro, nit_pro) VALUES ('$ide_pro', '$nit_pro')";

        // Ejecutar la consulta SQL para insertar el nuevo registro en la tabla prod_prov
        if (mysqli_query($conexion, $insert_prod_prov_query)) {
            // Mostrar un mensaje de éxito si se insertó el registro correctamente
            echo "El producto y el proveedor se han registrado correctamente.";
        } else {
            // Mostrar un mensaje de error si no se pudo insertar el registro
            echo "Error al registrar: " . mysqli_error($conexion);
        }
    } else {
        // Mostrar un mensaje de error si no se pudo insertar el producto
        echo "Error al registrar: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleproducts.css">
    <link rel="icon" type="image/png" href="logopagina.png"/>
    <title>Registrar nuevo producto y proveedor</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: montserrat;
            background: linear-gradient(150deg, rgb(31, 27, 27), #00CED1);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .table-wrapper {
            width: 400px;
            overflow: auto;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            padding: 20px;
        }

        .table-wrapper h2 {
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
            color: #008B8B;
        }

        .table-wrapper table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-wrapper table th,
        .table-wrapper table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table-wrapper table th {
            background-color: #f2f2f2;
            color: #008B8B;
        }

        .table-wrapper input[type="text"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-bottom: 2px solid #adadad;
            background: none;
            font-size: 16px;
            outline: none;
        }

        .table-wrapper label {
            color: #adadad;
            font-size: 16px;
        }

        .table-wrapper .registrar-button,
        .table-wrapper .productos-button {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #008B8B;
            border-radius: 25px;
            font-size: 18px;
            color: #ffffff;
            cursor: pointer;
            outline: none;
        }

        .table-wrapper .registrar-button:hover,
        .table-wrapper .productos-button:hover {
            background-color: #00CED1;
            color: #ffffff;
        }
        button {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #008B8B;
            border-radius: 25px;
            font-size: 18px;
            color: #ffffff;
            cursor: pointer;
            outline: none;
        }
        button:hover {
            background-color: #00CED1;
            color: #ffffff;
        }
        button a{
            color: #ffffff;
            text-decoration: none;
        }

       
    </style>
   
</head>
<body>
    <div class="table-wrapper">
        <h2>Registrar nuevo producto</h2>
        <form method="post">
            <table>
                <tr>
                    <td><label>Id del producto:</label></td>
                    <td><input type="text" name="ide_pro"></td>
                </tr>
                <tr>
                    <td><label>Nombre del producto:</label></td>
                    <td><input type="text" name="nom_prod"></td>
                </tr>
                <tr>
                    <td><label>Valor de venta:</label></td>
                    <td><input type="text" name="val_ven_pro"></td>
                </tr>
                <tr>
                    <td><label>Cantidad en stock:</label></td>
                    <td><input type="text" name="can_pro"></td>
                </tr>
                <tr>
                    <td><label>Valor de compra:</label></td>
                    <td><input type="text" name="val_com_pro"></td>
                </tr>
                <tr>
                    <td><label>Identificador de categoría:</label></td>
                    <td><input type="text" name="ide_cat"></td>
                </tr>
                <tr>
                    <td><label>Identificador de lote:</label></td>
                    <td><input type="text" name="ide_lot"></td>
                </tr>
            </table>
            <input type="submit" value="Registrar" class="registrar-button">
    </div>

    <div class="table-wrapper" style="margin-left: 20px;">
        <h2>Registrar nuevo proveedor</h2>
            <table>
                <tr>
                    <td><label>NIT:</label></td>
                    <td><input type="text" name="nit_pro"></td>
                </tr>
                <tr>
                    <td><label>Nombre:</label></td>
                    <td><input type="text" name="nom_prov"></td>
                </tr>
                <tr>
                    <td><label>Teléfono:</label></td>
                    <td><input type="text" name="tel_pro"></td>
    
                </tr>
            </table>
        </form>
    </div> 
    <button><a href="../view/products.php">Volver</a></button>
</body>
</html>   