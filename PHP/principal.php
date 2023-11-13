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
        .card {
            height: 400px;
        }

        .card-img-top {
            height: 100%;
            object-fit: cover;
        }

        .container {
            margin-bottom: 20px;
        }

        .container .row .col {
            padding: 20px;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row"> 
            <div class="col mt-5">
                <div class="card">
                    <img src="../IMG/resenas.png" class="card-img-top img-fluid" alt="Foto recetas">
                    <div class="card-body">
                        <h5 class="card-title">Recetas del casino</h5>
                        <p class="card-text">Todas las recetas de SABOR USM ¡ya disponibles!</p>
                        <a href="recetas.php" class="btn btn-primary">Mostrar más</a>
                    </div>
                </div>
            </div>

            <div class="col mt-5">
                <div class="card">
                    <img src="../IMG/votaciones.png" class="card-img-top img-fluid" alt="Votaciones">
                    <div class="card-body">
                        <h5 class="card-title">Votaciones de la semana</h5>
                        <p class="card-text">¡Ahora puedes escoger el plato de fondo de este viernes!</p>
                        <a href="votacion_semanal.php" class="btn btn-primary">Votar</a>
                    </div>
                </div>
            </div>

            <div class="col mt-5">
                <div class="card">
                    <img src="../IMG/top.jpg" class="card-img-top img-fluid" alt="Top">
                    <div class="card-body">
                        <h5 class="card-title">TOP RECETAS</h5>
                        <p class="card-text">Pincha para saber cuales son las 10 mejores y peores recetas según los usuarios</p>
                        <a href="top_recetas.php" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>