<?php
include_once("config.php");
session_start();
$id_receta = $_GET['id_receta'];
$id_usuario = $_GET['id_usuario'];
$eliminado = false;

if (isset($_SESSION['email'])) {
    $conn = Cconexion::ConexionBD();

    // llamada a procedimiento almacenado
    $sql_call ="CALL EliminarResena(?,?)";
    $stmt = $conn->prepare($sql_call);
    $stmt->execute([$id_usuario,$id_receta]);

    $eliminado = true;
    header("location: ver_resenas.php?eliminado=$eliminado"); 

} else {
    header("location: login.php");
    exit();
}

?>