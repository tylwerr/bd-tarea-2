<?php
include_once("config.php");
session_start();
$id_receta = $_GET['id_receta'];
$id_usuario = $_GET['id_usuario'];

if (isset($_SESSION['email'])) {
    $conn = Cconexion::ConexionBD();

    $sql = "DELETE FROM favoritos WHERE id_receta = ? AND id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_receta, $id_usuario]);
    header("location: favoritos.php"); 

} else {
    header("location: login.php");
    exit();
}

?>