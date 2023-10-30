<?php
include_once("config.php");
session_start();
$id_receta = '';
$mensaje = '';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $sql_usuario = "SELECT id, nombre_usuario FROM usuarios WHERE email = ?";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->execute([$email]);

    if ($stmt_usuario->rowCount() == 1) {
        $row_usuario = $stmt_usuario->fetch();
        $id_usuario = $row_usuario['id'];
        $nombre_usuario = $row_usuario['nombre_usuario'];

        $sql_favoritos = "SELECT id_receta FROM favoritos WHERE id_user = ?";
        $stmt_favoritos = $conn->prepare($sql_favoritos);
        $stmt_favoritos->execute([$id_usuario]);

        if ($stmt_favoritos->rowCount() == 0) {
            $mensaje = "¡Todavía no has agregado recetas a favoritos!";
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
        <div class="alert alert-primary" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php elseif(isset($_GET['eliminado']) && $_GET['eliminado'] == true ): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo "Receta eliminada de tus favoritos" ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row">

            <?php while ($row_favoritos = $stmt_favoritos->fetch(PDO::FETCH_ASSOC)) {
                $id_receta = $row_favoritos['id_receta'];
                
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
                            <a href="ver_receta.php?id_receta=<?php echo urlencode($id_receta);?>&mensaje=" class="btn btn-primary">Ver</a>
                            <a href="eliminar_favorito.php?id_receta=<?php echo urlencode($id_receta);?>&id_usuario=<?php echo urldecode($id_usuario)?>" class="btn delete">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>