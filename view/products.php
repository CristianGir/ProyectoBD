<?php
    include("../model/bdatos.php");

    if(isset($_POST["eliminar"])) {
        $ide_pro = $_POST['id'];
        $nit_pro = $_POST['nit'];
        $first_query = "DELETE FROM prod_prov WHERE ide_pro = '$ide_pro'";
        $second_query = "DELETE FROM productos WHERE ide_pro = '$ide_pro'";
        $third_query = "DELETE FROM proveedores WHERE nit_pro = '$nit_pro'";
        mysqli_query($conexion, $first_query);
        mysqli_query($conexion, $second_query);
        mysqli_query($conexion, $third_query);
    } 

    $query = "SELECT p.ide_pro, p.nom_pro, p.val_ven_pro, p.can_pro, p.val_com_pro, c.des_cat, l.fec_fab_lot, l.fec_ven_lot, pr.nit_pro, pr.nom_pro AS nom_prov FROM productos p
              JOIN categorias c ON p.ide_cat = c.ide_cat
              JOIN lotes l ON p.ide_lot = l.ide_lot
              JOIN prod_prov pp ON p.ide_pro = pp.ide_pro
              JOIN proveedores pr ON pp.nit_pro = pr.nit_pro";

    if (isset($_POST["searchTerm"])) {
        $searchTerm = $_POST["searchTerm"];
        $query .= " WHERE p.ide_lot LIKE '%$searchTerm%'";
    }

    $result = mysqli_query($conexion, $query);
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
    <title>Productos</title>
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
            <h2>Productos</h2>
            <button><a href="../controller/addProduct.php">Agregar producto</a></button>
            <button><a href="../index.html">Volver</a></button>
            <div class="input_search">
                <form method="POST" action="" onsubmit="showSpinner()">
                    <div class="search-wrapper">
                        <input type="search" name="searchTerm" placeholder="Buscar por ID del producto" />
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
                    <th>ID del producto</th>
                    <th>Nombre del producto</th>
                    <th>Valor venta</th>
                    <th>Cantidad</th>
                    <th>Valor compra</th>
                    <th>Descripcion categoria</th>
                    <th>Fecha Fabricación</th>
                    <th>Fecha vencimiento</th>
                    <th>Nombre proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // Verificar si hay resultados
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["ide_pro"]."</td>";
                    echo "<td>".$row["nom_pro"]."</td>";
                    echo "<td>".$row["val_ven_pro"]."</td>";
                    echo "<td>".$row["can_pro"]."</td>";
                    echo "<td>".$row["val_com_pro"]."</td>";
                    echo "<td>".$row["des_cat"]."</td>";
                    echo "<td>".$row["fec_fab_lot"]."</td>";
                    echo "<td>".$row["fec_ven_lot"]."</td>";
                    echo "<td>".$row["nom_prov"]."</td>";
                    echo "<td>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='id' value='" . $row["ide_pro"] . "'>";
                    echo "<input type='hidden' name='nit' value='" . $row["nit_pro"] . "'>"; // Agrega el campo oculto con el valor de $row["nit_pro"]
                    echo "<button type='submit' name='eliminar' value='Eliminar'><i class='bi bi-trash' id='icons'></i></button>"; // Agrega el botón con el icono de eliminación
                    echo "</form>";
                    echo "</td>";                    
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td colspan='4'>No se encontraron resultados.</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

</body>
</html>
