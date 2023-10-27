<?php
include("boton_volver.php");
include_once("config.php");
$conn = Cconexion::ConexionBD();
$sql = "SELECT * FROM recetas";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .cards-wrapper {
            column-gap: 15px;
        }

        .card-img-top {
            height: 100%;
            object-fit: cover;
        }


    </style>
</head>

<body>
    <h2 class="text-center my-5">Recetas</h2>
    
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="container cards-wrapper d-flex gx-5">
        <div class="row gy-3">
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $row['url_imagen']; ?>" class="card-img-top" alt="<?php echo $row['nombre_receta']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre_receta']; ?></h5>
                        <a href="valorar.php?nombre_receta=<?php echo urlencode($row['nombre_receta']);?>" class="btn btn-primary">Valorar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
