<?php
// Configuración para mantener la sesión durante un día (86400 segundos)
session_set_cookie_params(86400);
session_start();

function checkSession() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.html');
        exit();
    }
}

function redirectToPanel() {
    if (isset($_SESSION['tipo_usuario_id'])) {
        if ($_SESSION['tipo_usuario_id'] === 'cliente') {
            header('Location: /content/Catalogo/VistaCatalogo.php');
        } else if ($_SESSION['tipo_usuario_id'] === 'proveedor') {
            header('Location: ../content/indexproveedor.html ');
        }
        exit();
    }
}
?>
