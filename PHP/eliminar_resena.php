<?php
include_once("config.php");
session_start();
$id_receta = $_GET['id_receta'];
$id_usuario = $_GET['id_usuario'];
$eliminado = false;

if (isset($_SESSION['email'])) {
    $conn = Cconexion::ConexionBD();

    $sql = "DELETE FROM resenas WHERE id_receta = ? AND id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_receta, $id_usuario]);
    $eliminado = true;
    header("location: ver_resenas.php?eliminado=$eliminado"); 

} else {
    header("location: login.php");
    exit();
}

?>