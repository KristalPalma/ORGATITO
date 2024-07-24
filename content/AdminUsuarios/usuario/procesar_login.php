<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ORGATITO/index.html");
    exit;
}
 
// Include config file
require_once "usuariosbd.php";
 
// Define variables and initialize with empty values
$usuario = $contrasena = "";
$usuario_error = $contrasena_error = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["usuario"]))){
        $usuario_error = "Por fovor ingresa un usuario.";
    } else{
        $usuario = trim($_POST["usuario"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["contrasena"]))){
        $contrasena_error = "Por favor ingresa una contraseña.";
    } else{
        $contrasena = trim($_POST["contrasena"]);
    }
    
    // Validate credentials
    if(empty($usuario_error) && empty($contrasena_error)){
        // Prepare a select statement
        $sql = "SELECT usuario, contrasena FROM usuarios WHERE usuario = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_usuario);
            
            // Set parameters
            $param_usuario = $usuario;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $usuario, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($contrasena, $hashed_password)){
                            // Password is correct, so start a new session
                            $status = session_status();
                            if($status == PHP_SESSION_NONE){
                                //There is no active session
                                session_start();
                            }else
                            if($status == PHP_SESSION_DISABLED){
                                //Sessions are not available
                            }else
                            if($status == PHP_SESSION_ACTIVE){
                                //Destroy current and start new one
                                session_destroy();
                                session_start();
                            }
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["usuario"] = $usuario;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Nombre o Contraseña inválidos.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Nombre o Contraseña inválidos.";
                }
            } else{
                echo "¡Lo siento! Algo salió mal, intentélo de nuevo más tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
        <link rel="stylesheet" href="../../../styles/login.css">
        <a href="../../../index.html">Regresar</a>
</head>
<body>

<div class="login-container">
    <h2>ORGATITO </h2>
    <h3>Inicia sesión</h3>
    <form action="procesar_login.php" method="post">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
        <select id="tipoUsuario" name="tipoUsuario" required>
            <option value="">Seleccionar tipo de usuario</option>
            <option value="cliente">Cliente</option>
            <option value="proveedor">Proveedor</option>
          </select>          
        <div>
            <input type="checkbox" class="checkbox" id="remember" name="remember">
            <label for="remember">Recuérdame</label>
        </div>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <a href="recuperar_contra.html">¿Olvidaste tu contraseña?</a> | <a href="../usuario/crear_cuenta.php">Regístrate</a>
</div>

</body>
</html>

