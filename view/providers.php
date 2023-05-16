<?php
    include("../model/bdatos.php");

    if (isset($_POST["searchTerm"])) {
        $searchTerm = $_POST["searchTerm"];
        $proveedores = "SELECT p.nit_pro, p.nom_pro, p.tel_pro, pr.nom_pro as nom_producto FROM proveedores p
                        JOIN prod_prov pp ON p.nit_pro = pp.nit_pro
                        JOIN productos pr ON pp.ide_pro = pr.ide_pro
                        WHERE p.nit_pro LIKE '%$searchTerm%'";
        $result = mysqli_query($conexion, $proveedores);
    } else {
        $proveedores = "SELECT p.nit_pro, p.nom_pro, p.tel_pro, pr.nom_pro as nom_producto FROM proveedores p
                        JOIN prod_prov pp ON p.nit_pro = pp.nit_pro
                        JOIN productos pr ON pp.ide_pro = pr.ide_pro";
        $result = mysqli_query($conexion, $proveedores);
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
    <title>Proveedores</title>
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
            <h2>Proveedores</h2>
            <button><a href="../index.html">Volver</a></button>
            <div class="input_search">
                <form method="POST" action="" onsubmit="showSpinner()">
                    <div class="search-wrapper">
                        <input type="search" name="searchTerm" placeholder="Buscar por ID del lote" />
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
                    <th>NIT</th>
                    <th>Nombre proveedor</th>
                    <th>Teléfono</th>
                    <th>Nombre producto</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // Verificar si hay resultados
            if(mysqli_num_rows($result) > 0) {
                // Recorrer los resultados y mostrarlos en una tabla HTML
                echo "<table>";
                echo "<tr><th>NIT</th><th>Nombre</th><th>Teléfono</th><th>Producto</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["nit_pro"]."</td>";
                    echo "<td>".$row["nom_pro"]."</td>";
                    echo "<td>".$row["tel_pro"]."</td>";
                    echo "<td>".$row["nom_producto"]."</td>";
                    echo "</tr>";
                }
            }  else {
                echo "<tr>";
                echo "<td colspan='4'>No se encontraron resultados.</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />';
            ?>