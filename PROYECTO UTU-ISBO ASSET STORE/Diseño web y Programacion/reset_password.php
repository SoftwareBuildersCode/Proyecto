<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clientes_funciones.php';
$db = new Database();
$con = $db->conectar();

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($user_id == '' || $token == '') {
    header("Location: tienda.php");
    exit;
}

$errors = [];

if (!verificaToken($user_id, $token, $con)) {
    echo "No se pudo verificar la información";
    exit;
}

if (!empty($_POST)) {
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$user_id, $token, $password, $repassword])) {
        $errors[] = "Debe completar todos los campos";
    }
    if (!validarPassword($password, $repassword)) {
        $errors[] = "Las contraseñas no coinciden";
    }
    if (count($errors) == 0) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        if (actu_password($user_id, $pass_hash, $con)) {
            echo "Contraseña modificada.<br> <a href='login.php'>Iniciar sesión</a>";
            exit;
        } else {
            $errors[] = "Error al modificar contraseña";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'menu.php'; ?>
<main class="form-login m-auto pt-4">
   <h3>Cambiar contraseña</h3>

   <?php echo mensajes($errors); ?>

    <form action="reset_password.php" method="post" class="row g-3" autocomplete="off">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>"/>
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
       
        <div class="form-floating">
            <input class="form-control" type="password" name="password" id="password" placeholder="Nueva contraseña" required>
            <label for="password">Nueva contraseña:</label>
        </div>
        <div class="form-floating">
            <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Confirmar contraseña" required>
            <label for="repassword">Confirmar contraseña:</label>
        </div>

        <div class="d-grid gap-3 col-12">
            <button type="submit" class="btn btn-success">Continuar</button>
        </div>

        <hr>
        <div class="col-12">
            <a href="login.php">Iniciar sesión</a>
        </div>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
