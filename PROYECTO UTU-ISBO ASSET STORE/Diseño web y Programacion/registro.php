<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clientes_funciones.php';
$db = new Database();
$con = $db->conectar();

$errors=[];
if (!empty($_POST)) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $cedula = trim($_POST['cedula']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);
    
    if (esNulo([$nombre, $apellido, $email, $telefono, $cedula, $usuario, $password, $repassword])) {
        $errors[] = "Debe completar todos los campos";
    }
    
    if (!esEmail($email)) {
        $errors[] = "La dirección de correo $email no es válida";
    } elseif (correoExistente($email, $con)) {
        $errors[] = "La dirección de correo $email ya está registrada";
    }
    
    if (!validarPassword($password, $repassword)) {
        $errors[] = "Las contraseñas no coinciden";
    }
    
    if (usuarioExistente($usuario, $con)) {
        $errors[] = "El usuario $usuario ya está registrado";
    }
    
    if (count($errors) == 0) {
        $id = registrarCliente([$nombre, $apellido, $email, $telefono, $cedula], $con);
        if ($id > 0) {
            require 'clases/Mailer.php';
            $mailer = new Mailer();
            $token = generarToken();
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $idUsuario = registrarUsuario([$usuario, $pass_hash, $token, $id], $con);
            if ($idUsuario > 0) {
                $url = SITE_URL . '/activar_cliente.php?id=' . $idUsuario . '&token=' . $token;
                $asunto = "Activar cuenta - ASSET Store";
                $cuerpo = "$nombre, <br> Para autenticar su cuenta haga click en el siguiente enlace <a href='$url'>Activar cuenta</a>";
                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "Para terminar el registro revise su correo: $email";
                    exit;
                }
            } else {
                $errors[] = "Error al registrar usuario";
            }
        } else {
            $errors[] = "Error al registrar cliente";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="tienda.php" class="navbar-brand d-flex align-items-center">
                <strong class="custom-color">ASSET Store</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarHeader" aria-controls="navbarHeader" 
            aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contacto</a>
                    </li>
                </ul>
                <a href="checkout.php" class="btn btn-success">
                Carrito <span id="num_cart" class="badge bg-outline-success"><?php echo $num_cart; ?></span>
                </a>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <h2>Datos del cliente</h2>

        <?php mensajes($errors); ?>

        <form class="row g-2" action="registro.php" method="post" autocomplete="off">
            <div class="col-md-6">
                <label for="nombre"><span class="text-danger">*</span>Nombres</label>
                <input type="text" name="nombre" id="nombre" class="form-control"  required>

            </div>
            <div class="col-md-6">
                <label for="apellido"><span class="text-danger">*</span>Apellidos</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>

            </div>
            <div class="col-md-6">
                <label for="email"><span class="text-danger">*</span>Correo electronico</label>
                <input type="email" name="email" id="email" class="form-control"
                requireda>

            </div>
            <div class="col-md-6">
                <label for="telefono"><span class="text-danger">*</span>Telefono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control" required>

            </div>
            <div class="col-md-6">
                <label for="cedula"><span class="text-danger">*</span>Cedula</label>
                <input type="text" name="cedula" id="cedula" class="form-control" required>

            </div>
            <div class="col-md-6">
                <label for="usuario"><span class="text-danger">*</span>Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control"
                required>
                <span id="validaUsuario" class="text-danger"></span>

            </div>
            <div class="col-md-6">
                <label for="password"><span class="text-danger">*</span>Password</label>
                <input type="password" name="password" id="password" class="form-control" 
                required>

            </div>
            <div class="col-md-6">
                <label for="repassword"><span class="text-danger">*</span>Repeat password</label>
                <input type="password" name="repassword" id="repassword" class="form-control" 
                required>

            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </form> 
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

