<?php
include("top_bar.php");
$mensaje = '';

if (isset($_GET['orden'])){
    $orden = $_GET['orden'];
} else {
    $orden = "descendente";
}

if ($orden === "descendente"){
    $sql = "SELECT *
        FROM recetas
        ORDER BY promedio_calificaciones DESC
        LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() == 0){
        $mensaje = "Todavía no hay calificaciones";
    }

} elseif ($orden === "ascendente"){
    $sql = "SELECT *
            FROM recetas
            ORDER BY promedio_calificaciones ASC
            LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() == 0){
        $mensaje = "Todavía no hay calificaciones";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP RECETAS</title>

    <style>
         .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }
        
        .actualizar {
            color: #fff;
            background-color: #A93226;
        }

        .col-md-4 {
            padding: 20px;
            border-radius: 10px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .alert {
            width: 50%;
            margin: auto;
        }       
    
    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="principal.php" class="btn btn-back">Atrás</a>
    </div>
    <h2 class="text-center my-5">TOP RECETAS</h2>

    <?php if ($mensaje === "Todavía no hay calificaciones"): ?> 
        <div class="alert alert-primary text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    
    <div class="container">

        <form action="top_recetas.php" method="GET" class="mb-4">
            <div class="mt-2">
                <label for="orden" class="form-label">Elegir TOP:</label>
                <select name="orden" class="form-select" id="orden" style="max-width: 200px">
                    <option selected disabled>Seleccione una opcion:</option>
                    <option value="descendente">TOP 10 MEJORES</option>
                    <option value="ascendente">TOP 10 PEORES</option>
                </select>
                <button type="submit" class="btn btn-primary actualizar mt-2">Actualizar</button>
            </div>
        </form>

        <div class="row">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_receta = $row['id_receta'];
                $nombre_receta = $row['nombre_receta'];
                $promedio = $row['promedio_calificaciones'];
                $imagen = $row['url_imagen'];
            ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $imagen; ?>" class="card-img-top img-fluid" alt="<?php echo $nombre_receta; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $nombre_receta; ?></h5>
                            <p class="card-text"><?php echo "Promedio de calificaciones: " . number_format($promedio, 2); ?> </p>
                            <a href="ver_receta.php?id_receta=<?php echo urlencode($id_receta);?>&mensaje=" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

</body>
</html>