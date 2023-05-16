<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Definir una variable para almacenar el mensaje de éxito
$mensaje = "";

// Verificar si se ha enviado un formulario de registro de vendedor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $ide_ven = $_POST["ide_ven"];
    $nom_ven = $_POST["nom_ven"];
    $tel_ven = $_POST["tel_ven"];
    $email_ven = $_POST["email_ven"];

    // Preparar la consulta SQL para insertar un nuevo vendedor
    $insert_query = "INSERT INTO vendedor (ide_ven, nom_ven, tel_ven, email_ven) VALUES ('$ide_ven', '$nom_ven', '$tel_ven', '$email_ven')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_query)) {
        // Establecer el mensaje de éxito
        $mensaje = "El vendedor se ha registrado correctamente.";
    } else {
        // Mostrar un mensaje de error si no se pudo insertar el vendedor
        echo "Error al registrar el vendedor: " . mysqli_error($conexion);
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
    <title>Registrar nuevo vendedor</title> <!-- Agrega el título deseado aquí -->
</head>
<body>
    <div class="formulario">
        <h1>Registrar nuevo vendedor</h1>
        <form method="post">
            <div class="username">
                <input type="text" name="ide_ven" required>
                <label>Id</label>
            </div>
            <div class="username">
                <input type="text" name="nom_ven" required>
                <label>Nombre</label>
            </div>
            <div class="username">
                <input type="text" name="tel_ven" required>
                <label>Teléfono</label>
            </div>
            <div class="username">
                <input type="text" name="email_ven" required>
                <label>Email</label>
            </div>
            <input type="submit" value="Registrar" class="registrar-button" id="registrar-btn" required>
            <div class="usuarios">
                <button><a href="../view/sellers.php">Vendedores</a></button>
            </div>
        </form>
        <div class="mensaje"><?php echo $mensaje; ?></div> <!-- Mostrar el mensaje de éxito -->
    </div>
</body>
</html>
