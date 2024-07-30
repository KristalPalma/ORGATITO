<?php


function checkSession() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

function redirectToPanel() {
    if (isset($_SESSION['tipo_usuario_id'])) {

        if ($_SESSION['tipo_usuario_id'] === 'cliente') {
            header('Location: ../../Catalogo/VistaCatalogo.php');
        }
        else if ($_SESSION['tipo_usuario_id'] === 'proveedor') {
            header('Location: ../../indexproveedor.php');
        }
        exit();
    }
}
?>
