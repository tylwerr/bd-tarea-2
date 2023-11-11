<?php 
include("top_bar.php");
$sql = "SELECT * FROM recetas WHERE tipo_platillo = 'Plato de fondo' ORDER BY RAND() LIMIT 3 ";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votaciones</title>

    <style>
        .col-md-4 {
            padding: 20px;
            border-radius: 10px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
         .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }       
    
    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="principal.php" class="btn btn-back">Atrás</a>
    </div>
    <h2 class="text-center my-5">Votacion Semanal</h2>
    <div class="container">
        <div class="row">
            <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $row['url_imagen']; ?>" class="card-img-top img-fluid" alt="<?php echo $row['nombre_receta']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre_receta']; ?></h5>
                        <a href="ver_receta.php?id_receta=<?php echo urlencode($row['id_receta']);?>&mensaje=" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>







</body>
</html>