<?php
include("../model/bdatos.php");

if (isset($_POST["eliminar"])) {
    $id = $_POST["id"];
    $query = "DELETE FROM clientes WHERE ide_cli = '$id'";
    mysqli_query($conexion, $query);
}

if (isset($_POST["searchTerm"])) {
    $searchTerm = $_POST["searchTerm"];
    $clients = "SELECT * FROM clientes WHERE nom_cli LIKE '%$searchTerm%'";
    $result = mysqli_query($conexion, $clients);
} else {
    $clients = "SELECT * FROM clientes";
    $result = mysqli_query($conexion, $clients);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleclients.css">
    <link rel="icon" type="image/png" href="logo.png" />
    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 3px solid rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            border-top-color: #3498db;
            animation: spin 1s ease-in-out infinite;
        }
     

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        function showSpinner() {
            document.getElementById("overlay").style.display = "flex";
        }

        function hideSpinner() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
    <title>Clientes</title>
</head>
<body>
    <main class="main">
        <section class="contenedor-1">
            <header class="cabecera">
                <div class="logo">
                    <img src="logo.png" alt="Logo Farm Zelda">
                </div>
            </header>
        </section>
    </main>
  
    <div class="container">
        <div class="table_header">
            <h2>Clientes</h2>
            <button><a href="../controller/addClient.php">Agregar usuario</a></button>
            <button><a href="../index.html">Volver</a></button>
            <div class="input_search">
                <form method="POST" action="" onsubmit="showSpinner()">
                    <div class="search-wrapper">
                        <input type="search" name="searchTerm" placeholder="Buscar por nombre" />
                        <button type="submit" name="searchButton" class="search-button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="overlay" class="overlay">
            <div class="spinner"></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID del cliente</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["ide_cli"] . "</td>";
                        echo "<td>" . $row["nom_cli"] . "</td>";
                        echo "<td>" . $row["tel_cli"] . "</td>";
                        echo "<td>" . $row["dir_cli"] . "</td>";
                        echo "<td>" . $row["email_cli"] . "</td>";
                        echo "<td>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' name='id' value='" . $row["ide_cli"] . "'>";
                        echo "<button type='submit' name='eliminar' value='Eliminar'><i class='bi bi-trash' id='icons'></i></button>"; // Agrega el botón con el icono de eliminación
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
  } else {
    echo "<tr>";
    echo "<td colspan='6'>No se encontraron resultados.</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo '  <div class="table_footer">';
  echo '  </div>';
  echo '</div>';
  echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />';
  ?>
