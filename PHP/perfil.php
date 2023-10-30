<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}
include("config.php");
$conn = Cconexion::ConexionBD();
$email = $_SESSION['email'];
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$showEditForm = false;
$showDeleteButton = true;
$showConfirmDelete = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        $showEditForm = true;
        $showDeleteButton = false;
        $showConfirmDelete = false;
    } elseif (isset($_POST['cancel_edit'])) {
        $showEditForm = false;
        $showDeleteButton = true;
        $showConfirmDelete = false;
    } elseif (isset($_POST['confirm_delete'])) {
        $showEditForm = false;
        $showDeleteButton = false;
        $showConfirmDelete = true;
    } elseif (isset($_POST['cancel_delete'])) {
        $showEditForm = false;
        $showDeleteButton = true;
        $showConfirmDelete = false;
    } elseif (isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_email']) && isset($_POST['nueva_cantidad_almuerzos'])) {
        $nuevo_nombre = $_POST['nuevo_nombre'];
        $nuevo_email = $_POST['nuevo_email'];
        $nuevo_cantidad_almuerzos = $_POST['nueva_cantidad_almuerzos'];
        $sql = "UPDATE usuarios SET nombre_usuario = ?, email = ?, cantidad_almuerzos = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nuevo_nombre, $nuevo_email, $nuevo_cantidad_almuerzos, $email]);
        if ($nuevo_email != $email) {
            $_SESSION['email'] = $nuevo_email;
            $email = $nuevo_email;
        }
        header('location: perfil.php');
    } elseif (isset($_POST['delete_account'])) {
        $sql = "DELETE FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        session_destroy();
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .left {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }
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
        .container {
            margin: 0 auto;
            display: table;
        }

        .left {
            float: left;
            width: 214px;
            height: 366px;
        }

        .right {
            float: right;
            width: 80%;
        }

        .image {
            margin: 0 auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 1px solid wheat;
            display: inline-block;
            padding: 3px;
            border: 3px solid gray;
            margin-top: 20px;
            margin-right: 57px;
            margin-left: 50px;
        }

        .username {
            font-size: 21px;
            margin-top: 5px;
        }

        .btn {
            margin: 0 auto;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;

        }

        .left.box-primary {
            border-top-color: #3c8dbc;
    
        }
        .form-group {
            margin-bottom: 15px;
        }
        .custom-edit-button {
            background-color: #28a745; 
            color: #fff; 
            border: 1px #28a745; 
            padding: 8px 16px; 
            border-radius: 4px; 
            cursor: pointer; 
        }
        .custom-delete-button {
            background-color: red; 
            color: #fff; 
            border: 1px red; 
            padding: 8px 16px; 
            border-radius: 4px; 
            cursor: pointer; 
        }

        .custom-edit-button:hover {
            background-color: #218838; 
        }
        .custom-delete-button:hover {
            background-color: #218838; 
        }

        .boton {
            padding: 10px;
            background-color: blue;
            color: white;
        }

        .btn-favorite {
            background-color: #F1C40F; 
            color: #fff; 
            border: 1px #28a745; 
            padding: 8px 16px; 
            border-radius: 4px; 
            cursor: pointer; 
        }

        .btn-resenas {
            background-color: #9C27B0; 
            color: #fff; 
            border: 1px #28a745; 
            padding: 8px 16px; 
            border-radius: 4px; 
            cursor: pointer; 
        }

    </style>
</head>

<body>
    <main>
        <div class="top-bar">
            <img class="right-image" src="//aula.usm.cl/pluginfile.php/1/theme_moove/logo/1697696553/marca-color.png" alt="USM04">
        </div>
        <div style="margin: 10px;">
            <a href="principal.php" class="btn btn-primary">Atrás</a>
        </div>
        <div class="container">
            <div class="left box-primary">
                <img class="image" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Imagen de Usuario" />
                <h3 class="username text-center"><?php echo htmlspecialchars($user['nombre_usuario']); ?></h3>
                <div class="text-center">
                    <a href="favoritos.php" class="btn btn-favorite">Favoritos</a>
                    <a href="ver_resenas.php" class="btn btn-resenas">Ver tus reseñas</a>
                </div>           
            </div>
            <div class="right tab-content">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre Usuario</label>
                        <div class="col-sm-10">
                        <p class="form-control" readonly><?php echo htmlspecialchars($user['nombre_usuario']); ?></p>  
                        </div>
                    </div>
                                
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                        <p class="form-control" readonly><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Última Sesión</label>
                        <div class="col-sm-10">
                            <p class="form-control" readonly><?php echo htmlspecialchars($user['ultima_sesion']); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cantidad Almuerzos</label>
                        <div class="col-sm-10">
                            <p class="form-control" readonly><?php echo htmlspecialchars($user['cantidad_almuerzos']); ?></p>
                        </div>
                    </div>
                </form>
            
                <?php if ($showEditForm): ?>
                    <button id="editButton" class="custom-edit-button" onclick="document.getElementById('cancel_edit_form').submit();">Cancelar</button>
                <?php else: ?>
                    <button id="editButton" class="custom-edit-button" onclick="document.getElementById('edit_form').submit();">Editar</button>
                <?php endif; ?>
                
                <?php if ($showConfirmDelete): ?>
                    <button id="deleteButton" class="custom-delete-button" onclick="document.getElementById('cancel_delete_form').submit();">Cancelar</button>
                <?php elseif ($showDeleteButton): ?>
                    <button id="deleteButton" class="custom-delete-button" onclick="document.getElementById('confirm_delete_form').submit();">Eliminar Cuenta</button>
                <?php endif; ?>

                <div id="confirmDelete" style="display: <?php echo $showConfirmDelete ? 'block' : 'none'; ?>;">
                    <p>¿Estás seguro que quieres eliminar tu cuenta?</p>
                    <form method="POST" action="perfil.php">
                        <input type="hidden" name="delete_account" value="true">
                        <button class="custom-delete-button" type="submit">Sí, Eliminar</button>
                    </form>
                </div>
                <div id="editForm" style="display: <?php echo $showEditForm ? 'block' : 'none'; ?>;">
                    <h3 style="font-weight: bold; font-size: 20px; margin-top: 20px;">Editar Nombre de Usuario</h3>
                    <form method="POST" action="perfil.php">
                        <label for="nuevo_email" style="font-weight; margin-top: 10px">Nuevo Correo Electrónico:</label>
                        <input type="email" id="nuevo_email" name="nuevo_email" required style="width: 100%; padding: 8px; border: 1px solid #d2d6de; border-radius: 4px; margin-bottom: 15px;">
                        <label for="nuevo_nombre" style="font-weight; margin-top: 10px">Nuevo nombre:</label>
                        <input type="text" id="nuevo_nombre" name="nuevo_nombre" required style="width: 100%; padding: 8px; border: 1px solid #d2d6de; border-radius: 4px; margin-bottom: 15px;">
                        <label for="nueva_cantidad_almuerzos" style="font-weight; margin-top: 10px;">Nueva cantidad de almuerzos:</label>
                        <input type="number" id="nueva_cantidad_almuerzos" name="nueva_cantidad_almuerzos" required style="width: 100%; padding: 8px; border: 1px solid #d2d6de; border-radius: 4px; margin-bottom: 15px;">
                        <input type="submit" value="Guardar Cambios" class="btn custom-edit-button" style="font-weight: bold; width: 100%; background-color: #28a745; color: #fff; border: 1px solid #28a745; padding: 8px 16px; border-radius: 4px; cursor: pointer; margin-top: 15px;">
                        
                    </form>
                </div>

            </div>


<form id="edit_form" method="POST">
    <input type="hidden" name="edit">
</form>
<form id="cancel_edit_form" method="POST">
    <input type="hidden" name="cancel_edit">
</form>
<form id="confirm_delete_form" method="POST">
    <input type="hidden" name="confirm_delete">
</form>
<form id="cancel_delete_form" method="POST">
    <input type="hidden" name="cancel_delete">
</form>

</body>
</html>