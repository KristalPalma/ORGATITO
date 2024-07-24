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
                        if(password_verify($password, $hashed_password)){
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body><center>
    <div class="wrapper">
        <h2>Iniciar sesión</h2>
        <p>Por favor, introduzca sus datos para Iniciar Sesión.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>¿No tienes una cuenta? <a href="register.php">Registrate</a>.</p>
        </form>
    </div></center>
</body>
</html>