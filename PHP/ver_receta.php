<?php
include("top_bar.php");
$id_receta = $_GET['id_receta'];
$mensaje = $_GET['mensaje'];

$sql_info_receta = "SELECT nombre_receta, promedio_calificaciones, tipo_platillo, tiempo_preparacion, etiquetas, instrucciones, ingredientes, url_imagen
                    FROM recetas
                    WHERE id_receta = ?";

$stmt_info_receta = $conn->prepare($sql_info_receta);
$stmt_info_receta->execute([$id_receta]);

if ($stmt_info_receta->rowCount() == 1) {
    $row_info_receta = $stmt_info_receta->fetch();
    $nombre_receta = $row_info_receta['nombre_receta'];
    $promedio = $row_info_receta['promedio_calificaciones'];
    $tipo_platillo = $row_info_receta['tipo_platillo'];
    $tiempo_preparacion = $row_info_receta['tiempo_preparacion'];
    $etiquetas = $row_info_receta['etiquetas'];
    $instrucciones = $row_info_receta['instrucciones'];
    $ingredientes = $row_info_receta['ingredientes'];
    $url_imagen = $row_info_receta['url_imagen'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseña</title>

    <style>
        .col-sm-6 {
            padding: 20px;
            border-radius: 10px;
        }

        .card-img-top {
            height: 400px;
            object-fit: cover;
        }

        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .btn-favorite {
            color: #fff;
            background-color: #F1C40F;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .btn-resena {
            color: #fff;
            background-color: #BA4A00 ;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .alert {
            width: 50%;
            margin: auto;
        }

    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="recetas.php" class="btn btn-primary">Atrás</a>
    </div>
    <h2 class="text-center my-5"><?php echo $nombre_receta; ?></h2>

    <?php if ($mensaje === "¡Receta agregada a favoritos!"): ?> 
        <div class="alert alert-warning" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php elseif($mensaje === "¡Esta receta ya está en tus favoritos!"): ?>
        <div class="alert alert-dark" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    
    <div class="row justify-content-center">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card mb-3">
                <img src="<?php echo $url_imagen; ?>" class="card-img-top" alt="<?php echo $nombre_receta; ?>">
                <div class="card-body">
                    <p class="card-text"><?php echo "Tipo de platillo: " . $tipo_platillo . "<br>" .
                    "Tiempo de preparación: " . $tiempo_preparacion . "<br>" .
                    "Etiquetas: " . $etiquetas . "<br>" .
                    "Ingredientes: " . $ingredientes . "<br>" .
                    "Instrucciones: " . $instrucciones; ?></p>
                    <p class="card-text"><small class="text-body-secondary"><?php echo "Promedio de calificaciones: " . number_format($promedio, 2); ?></small></p>
                </div>
                <form method="POST" action="agregar_favorito.php">
                    <input type="hidden" name="id_receta" value="<?php echo $id_receta; ?>">
                    <div style="margin: 10px;">
                        <a href="valorar.php?id_receta=<?php echo $id_receta?>" class="btn btn-primary">Valorar</a>
                        <button type="submit" class="btn btn-favorite" name="agregar_favorito">Añadir a favoritos</button>
                        <a href="resenas_usuarios.php?id_receta=<?php echo $id_receta?>" class="btn btn-resena">Ver reseñas</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>