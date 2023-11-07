<?php
include("top_bar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>

    <style>
        body {
            font-family: Arial, sans-serif; 
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .votar {
            height: 300px;
            object-fit: cover;           
        }

        .container {
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row align-items-stretch">
            <div class="col mt-5">
                <div class="card">
                    <img src="../IMG/resenas.png" class="card-img-top votar img-fluid" alt="Foto recetas">
                    <div class="card-body">
                        <h5 class="card-title">Recetas del casino</h5>
                        <p class="card-text">Todas las recetas de SABOR USM ¡ya disponibles!</p>
                        <a href="recetas.php" class="btn btn-primary">Mostrar más</a>
                    </div>
                </div>
            </div>

            <div class="col mt-5">
                <div class="card">
                    <img src="../IMG/votaciones.png" class="card-img-top votar img-fluid" alt="Votaciones">
                    <div class="card-body">
                        <h5 class="card-title">Votaciones de la semana</h5>
                        <p class="card-text">¡Ahora puedes escoger el plato de fondo de este viernes!</p>
                        <a href="votar.php" class="btn btn-primary">Votar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>