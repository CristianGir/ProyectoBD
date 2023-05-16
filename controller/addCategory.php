<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

$mensaje = "";
// Verificar si se ha enviado un formulario de registro de categoría
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $ide_cat = $_POST["ide_cat"];
    $des_cat = $_POST["des_cat"];

    // Preparar la consulta SQL para insertar una nueva categoría
    $insert_query = "INSERT INTO categorias (ide_cat, des_cat) VALUES ('$ide_cat', '$des_cat')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_query)) {
        // Establecer el mensaje de éxito
        $mensaje = "La categoría se ha registrado correctamente.";
    } else {
        // Establecer el mensaje de error
        $mensaje = "Error al registrar la categoría: " . mysqli_error($conexion);
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
    <title>Registrar nueva categoría</title> <!-- Agrega el título deseado aquí -->

</head>
<body>
    <div class="formulario">
        <h1>Registrar nueva categoría</h1>
        <form method="post">
            <div class="username">
                <input type="text" name="ide_cat" required>
                <label>Id</label>
            </div>
            <div class="username">
                <input type="text" name="des_cat" required>
                <label>Descripción</label>
            </div>
            <input type="submit" value="Registrar" class="registrar-button" id="registrar-btn" required>
            <div class="usuarios">
                <button><a href="../view/categories.php">Categorias</a></button>
            </div>
        </form>
        
        <!-- Mostrar el mensaje de éxito debajo de la tabla -->
        <div class="mensaje"><?php echo $mensaje; ?></div>
    </div>
</body>
</html>
