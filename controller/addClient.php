<?php
// Incluir el archivo de conexión a la base de datos
include("../model/bdatos.php");

// Definir una variable para almacenar el mensaje de éxito
$mensaje = "";

// Verificar si se ha enviado un formulario de registro de cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $ide_cli = $_POST["ide_cli"];
    $nom_cli = $_POST["nom_cli"];
    $tel_cli = $_POST["tel_cli"];
    $dir_cli = $_POST["dir_cli"];
    $email_cli = $_POST["email_cli"];

    // Preparar la consulta SQL para insertar un nuevo cliente
    $insert_query = "INSERT INTO clientes (ide_cli, nom_cli, tel_cli, dir_cli, email_cli) VALUES ('$ide_cli', '$nom_cli', '$tel_cli', '$dir_cli', '$email_cli')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $insert_query)) {
        // Establecer el mensaje de éxito
        $mensaje = "El cliente se ha registrado exitosamente.";
    } else {
        // Mostrar un mensaje de error si no se pudo insertar el cliente
        echo "Error al registrar el cliente: " . mysqli_error($conexion);
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
    <title>Registrar nuevo cliente</title> <!-- Agrega el título deseado aquí -->
</head>
<body>
    <div class="formulario">
        <h1>Registrar nuevo cliente</h1>
        <form method="post">
            <div class="username">
                <input type="text" name="ide_cli" required>
                <label>Id</label>
            </div>
            <div class="username">
                <input type="text" name="nom_cli" required>
                <label>Nombre</label>
            </div>
            <div class="username">
                <input type="text" name="tel_cli" required>
                <label>Teléfono</label>
            </div>
            <div class="username">
                <input type="text" name="dir_cli" required>
                <label>Dirección</label>
            </div>
            <div class="username">
                <input type="text" name="email_cli" required>
                <label>Email</label>
            </div>
            <input type="submit" value="Registrar" class="registrar-button" id="registrar-btn" required>
            <div class="usuarios">
                <button><a href="../view/clients.php">Usuarios</a></button>
            </div>
        </form>
        <div class="mensaje"><?php echo $mensaje; ?></div> <!-- Mostrar el mensaje de éxito -->
    </div>
</body>
</html>


