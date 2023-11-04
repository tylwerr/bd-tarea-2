<?php
include_once("config.php");
session_start();
$mensaje = '';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $conn = Cconexion::ConexionBD();

    $sql_usuario = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->execute([$email]);

    if ($stmt_usuario->rowCount() == 1) {
        $row_usuario = $stmt_usuario->fetch();
        $id_usuario = $row_usuario['id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_favorito'])) {
    $id_receta = $_POST['id_receta'];
    $sql_favorito = "SELECT COUNT(*) AS num_favoritos FROM favoritos WHERE id_user = ? AND id_receta = ?";
    $stmt_favorito = $conn->prepare($sql_favorito);
    $stmt_favorito->execute([$id_usuario, $id_receta]);
    $es_favorito = ($stmt_favorito->fetchColumn() > 0);

    if ($es_favorito) {
        $mensaje = "¡Esta receta ya está en tus favoritos!";
        header("location: ver_receta.php?id_receta=$id_receta&mensaje=$mensaje");
        exit();

    } else {
        $sql_insert = "INSERT INTO favoritos (id_user, id_receta) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->execute([$id_usuario, $id_receta]);

        $mensaje = "¡Receta agregada a favoritos!";
        header("location: ver_receta.php?id_receta=$id_receta&mensaje=$mensaje");
        exit();
    }
}

?>