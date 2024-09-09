<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clientes_funciones.php';
$db = new Database();
$con = $db->conectar();

$errors=[];

if(!empty($_POST)){
    $email = trim($_POST['email']);

    if(esNulo([$email])){
        $errors[ ] = "Debe complentar todos los campos ";
    }
    if(!esEmail($email)){
        $errors[] = "La direccion de correo $email no es valida";
    }
    if(count($errors)== 0){
        if(correoExistente($email, $con)){
            $sql = $con->prepare("SELECT usuarios.id, clientes.nombre FROM usuarios INNER JOIN clientes ON usuarios.id_cliente = clientes.id WHERE clientes.email LIKE ? LIMIT 1");

            $sql->execute([$email]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $user_id = $row['id'];
            $nombre = $row['nombre'];

            $token = soliPassword($user_id, $con);

            if($token !== null ){
                require 'clases/Mailer.php';
                $mailer = new Mailer();

                $url = SITE_URL . '/reset_password.php?id=' . $user_id . '&token=' . $token;

                $asunto = "Recuperar contraseña - ASSET Store";
                $cuerpo = "$nombre, <br> Si ha solicitado el cambio de su contraseña, siga el siguiente enlace: <a href='$url'>$url</a>.";
                $cuerpo .= "<br>Si usted no hizo esta solicitud, por favor ignore este correo.";

                if($mailer->enviarEmail($email, $asunto, $cuerpo)){
                    echo "<p><b>Correo enviado </b></p>";
                    echo "<p><b>Enviamos un correo a $email para restablecer la contraseña</b></p>";
                    exit;
                }
            }
        }else{
            $errors[] = "No existe una cuenta en este corro";
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
                <a href="checkout.php" class="btn btn-success"><i class="fa-solid fa-cart-shopping"></i>
                Carrito <span id="num_cart" class="badge bg-outline-success"><?php echo $num_cart; ?></span>
                </a>
            </div>
        </div>
    </div>
</header>
<main class="form-login m-auto pt-4">
   <h3>Recuperar contraseña</h3>

   <?php echo mensajes($errors); ?>

    <form action="recupera_contrasena.php" method="post" class="row g-3" autocomplete="off">
        <div class="form-floating">
            <input class="form-control" type="email" name="email" id="email" placeholder="Correo electronico" required>
            <label for="email">Correo electronico:</label>
        </div>

        <div class="d-grid gap-3 col-12">
            <button type="submit" class="btn btn-success">Solicitar cambio</button>
        </div>

        <hr>
        <div class="col-12">
            No tienes cuenta? <a href="registro.php">Registrate</a>
        </div>
    </form>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/348f0f7040.js" crossorigin="anonymous"></script>
</body>
</html>

