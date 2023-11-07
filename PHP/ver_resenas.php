<?php
include("top_bar.php");
$mensaje = '';

if (isset($_SESSION['email'])) {

    $sql = "SELECT vr.id_user, vr.id_receta, vr.calificacion, vr.comentario, vr.fecha_resena, r.nombre_receta
            FROM vista_resenas vr
            JOIN recetas r ON r.id_receta = vr.id_receta
            WHERE vr.email_usuario = ?
            ORDER BY vr.fecha_resena DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() == 0) {
        $mensaje = "¡Todavía no has hecho reseñas!";
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
    <title>Tus reseñas</title>

    <style>
        body {
            font-family: Arial, sans-serif; 
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;

        }

        .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .col-md-5 {
            background: #f3f3f3; 
            padding: 20px;
            border-radius: 10px;
            margin: auto;
        }

        label.col.control-label {
            margin-left: 10px;
        }
        
        .form-horizontal {
            margin: 30px;
        }

        .alert {
            width: 25%;
            margin: auto;
        }

        .container {
            margin: auto;
        }

    </style>
</head>

<body>
    <div style="margin: 10px;">
        <a href="perfil.php" class="btn btn-back">Atrás</a>
    </div>

    <?php if ($mensaje === "¡Todavía no has hecho reseñas!"): ?> 
        <div class="alert alert-primary text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php elseif(isset($_GET['eliminado']) && $_GET['eliminado'] == true ): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo "Reseña eliminada" ?>
        </div>
    <?php endif; ?>


    <div class="container">
        <?php if ($stmt->rowCount() > 0) {?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_usuario = $row['id_user'];
                $id_receta = $row['id_receta'];
                $calificacion = $row['calificacion'];
                $comentario = $row['comentario'];
                $fecha_resena = $row['fecha_resena'];
                $nombre_receta = $row['nombre_receta']; ?>

                <div class="col-md-5">
                    <div class="card">
                        <h3 class="text-center my-3"><?php echo $nombre_receta?></h3>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col control-label">Calificación</label>
                                <p class="form-control text-center" readonly><?php echo htmlspecialchars($calificacion); ?></p>
                            </div>
                                            
                            <div class="form-group">
                                <label class="col control-label">Comentario</label>
                                <p class="form-control text-center" readonly><?php echo htmlspecialchars($comentario); ?></p>
                            </div>

                            <div class="form-group">
                                <label class="col control-label">Fecha</label>
                                <p class="form-control text-center" readonly><?php echo htmlspecialchars($fecha_resena); ?></p>
                            </div>
                                
                            <div class="form-group text-center">
                                <a href="editar_resena.php?id_receta=<?php echo urlencode($id_receta);?>&id_usuario=<?php echo urldecode($id_usuario);?>&nombre_receta=<?php echo urldecode($nombre_receta)?>" class="btn btn-primary">Editar</a>
                                <a href="eliminar_resena.php?id_receta=<?php echo urlencode($id_receta);?>&id_usuario=<?php echo urldecode($id_usuario)?>" class="btn btn-danger">Eliminar</a>
                            </div>
                        </form>            
                    </div>
                </div>
        <?php } }?>
    </div>

</body>
</html>