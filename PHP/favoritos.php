<?php
include("top_bar.php");
$id_receta = '';
$mensaje = '';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $sql_favoritos = "SELECT id, nombre_usuario, f.id_receta 
                      FROM usuarios u
                      JOIN favoritos f ON f.id_user = u.id
                      WHERE email = ?";
    $stmt_favoritos = $conn->prepare($sql_favoritos);
    $stmt_favoritos->execute([$email]);

    if ($stmt_favoritos->rowCount() == 0) {
        $mensaje = "¡Todavía no has agregado recetas a favoritos!";
    }

} else {
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>

    <style>
        .col-md-4 {
            background: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        .back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #2E86C1; 
            color: #fff; 
            border: 1px #2E86C1; 
            padding: 5px 14px; 
            border-radius: 4px;
        }

        .delete {
            background-color: #D32F2F; 
            color: #fff; 
            border: 1px #D32F2F; 
            padding: 5px 14px; 
            border-radius: 4px;  
        }
        
        .alert {
            width: 50%;
            margin: auto;
        }
    
    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="principal.php" class="btn back">Atrás</a>
    </div>
    <h2 class="text-center my-5">Tus recetas favoritas</h2>

    <?php if ($mensaje === "¡Todavía no has agregado recetas a favoritos!"): ?> 
        <div class="alert alert-primary text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php elseif(isset($_GET['eliminado']) && $_GET['eliminado'] == true ): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo "Receta eliminada de tus favoritos" ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row">

            <?php while ($row_favoritos = $stmt_favoritos->fetch(PDO::FETCH_ASSOC)) {
                $id_receta = $row_favoritos['id_receta'];
                $id_usuario = $row_favoritos['id'];
                
                $sql_receta = "SELECT * FROM recetas WHERE id_receta = ?";
                $stmt_receta = $conn->prepare($sql_receta);
                $stmt_receta->execute([$id_receta]);
                
                if ($stmt_receta->rowCount() > 0) {
                    $receta = $stmt_receta->fetch(PDO::FETCH_ASSOC); ?>

                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $receta['url_imagen']; ?>" class="card-img-top img-fluid" alt="<?php echo $receta['nombre_receta']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $receta['nombre_receta']; ?></h5>
                            <p class="card-text"><?php echo "Promedio de calificaciones: " . number_format($receta['promedio_calificaciones'], 2); ?> </p>
                            <a href="ver_receta.php?id_receta=<?php echo urlencode($id_receta);?>&mensaje=" class="btn btn-primary">Ver</a>
                            <a href="eliminar_favorito.php?id_receta=<?php echo urlencode($id_receta);?>&id_usuario=<?php echo urldecode($id_usuario)?>" class="btn delete">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>

</body>
</html>