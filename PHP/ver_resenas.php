<?php
include_once("config.php");
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $sql = "SELECT vr.id_user, vr.id_receta, vr.calificacion, vr.comentario, vr.fecha_resena
            FROM vista_resenas vr
            WHERE vr.email_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif; 
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .top-bar {
            background-color: #074469;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .right-image {
            width: 300px;
            height: 60px;
            margin-right : 10px;
        }

         .btn-back {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
        }

        .col-md-4 {
            background: #f3f3f3; 
            padding: 20px;
            border-radius: 10px;
        }       
        label.col.control-label {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <img class="right-image" src="//aula.usm.cl/pluginfile.php/1/theme_moove/logo/1697696553/marca-color.png" alt="USM04">
    </div>
    <div style="margin: 10px;">
        <a href="perfil.php" class="btn btn-back">Atrás</a>
    </div>


    <div class="container">
        <div class="row">

            <?php if ($stmt->rowCount() > 0) {?>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_usuario = $row['id_user'];
                    $id_receta = $row['id_receta'];
                    $calificacion = $row['calificacion'];
                    $comentario = $row['comentario'];
                    $fecha_resena = $row['fecha_resena']; ?>

                    <div class="col-md-4">
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col control-label">Calificación</label>
                                    <div class="col-sm-10">
                                    <p class="form-control" readonly><?php echo htmlspecialchars($calificacion); ?></p>  
                                    </div>
                                </div>
                                            
                                <div class="form-group">
                                    <label class="col control-label">Comentario</label>
                                    <div class="col-sm-10">
                                    <p class="form-control" readonly><?php echo htmlspecialchars($comentario); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col control-label">Fecha</label>
                                    <div class="col-sm-10">
                                        <p class="form-control" readonly><?php echo htmlspecialchars($fecha_resena); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <a href="editar_resena.php?id=<?php echo $id_receta; ?>" class="btn btn-primary">Editar</a>
                                        <a href="eliminar_resena.php?id=<?php echo $id_receta; ?>" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </form>            
                        </div>
                    </div>
            <?php } }?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>