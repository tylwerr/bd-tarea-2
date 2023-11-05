<?php
include_once("config.php");
session_start();
$id_receta = $_GET['id_receta'];
$id_usuario = $_GET['id_usuario'];
$eliminado = false;

if (isset($_SESSION['email'])) {
    $conn = Cconexion::ConexionBD();

    $sql_delete = "DELETE FROM resenas
                   WHERE id_receta = ? AND id_user = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->execute([$id_receta, $id_usuario]);

    $sql_select = "SELECT AVG(calificacion) AS promedio
                   FROM resenas
                   WHERE id_receta = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->execute([$id_receta]);

    if ($stmt_select->rowCount() > 0) {
        // Obtener el promedio de las calificaciones y actualizarlo
        $row_promedio = $stmt_select->fetch();
        $promedio = $row_promedio["promedio"];

        $sql_update = "UPDATE recetas
                       SET promedio_calificaciones = ?
                       WHERE id_receta = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([$promedio, $id_receta]);
    }

    $eliminado = true;
    header("location: ver_resenas.php?eliminado=$eliminado"); 

} else {
    header("location: login.php");
    exit();
}

?>