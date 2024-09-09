<?php
function esNulo(array $parametros){
    foreach($parametros as $parametro){
        if(strlen(trim($parametro)) < 1){
            return true;
        }
    }
    return false;
}

function esEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarPassword($password , $repassword){
    if(strcmp($password, $repassword)!== 0){
        return false;
    }
    return true;
}

function generarToken() {
    return md5(uniqid(mt_rand(), false));
}

function registrarCliente(array $datos, $con) {
    $sql = $con->prepare("INSERT INTO clientes (nombre, apellido, email, telefono, cedula, estatus, fecha_alta) VALUES(?,?,?,?,?, 1, now())");
    if ($sql->execute($datos)) { 
        return $con->lastInsertId();  
    }
    return 0;
}

function registrarUsuario(array $datos, $con) {
    $sql = $con->prepare("INSERT INTO usuarios (usuario, password, token, id_cliente) VALUES(?,?,?,?)");
    if ($sql->execute($datos)) {  
        return $con->lastInsertId();
    }
    return 0;
}

function usuarioExistente($usuario, $con) {
    $sql = $con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    if($sql->fetchColumn() > 0){ 
        return true;
    }
    return false;
}

function correoExistente($email, $con) {
    $sql = $con->prepare("SELECT id FROM clientes WHERE email LIKE ? LIMIT 1");
    $sql->execute([$email]);
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
}

function mensajes(array $errors) {
    if(count($errors) > 0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors as $error){
            echo '<li>'. $error . '</li>';
        }
        echo '</ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

function validaToken($id, $token, $con) {
    $msg ="";
    $sql = $con->prepare("SELECT id FROM usuarios WHERE id = ? AND token LIKE ? LIMIT 1");
    $sql->execute([$id, $token]);
    if($sql->fetchColumn() > 0){
        if(activarUsuario($id, $con)){
            $msg = "Cuenta activada.";
        }else{
            $msg= "Error al activar la cuenta";
        }
    }else{
        $msg = "Error del servidor";
    }
    return $msg;
}

function activarUsuario($id, $con){
    $sql = $con->prepare("UPDATE usuarios SET activo = 1 WHERE id = ?");
    return $sql->execute([$id]);
}
function login($usuario, $password, $con, $proceso) {
    $sql = $con->prepare("SELECT id, usuario, password, id_cliente FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        if (esActivo($usuario, $con)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['usuario'];
                $_SESSION['user_cliente'] = $row['id_cliente'];
                if($proceso == 'pago'){
                    header("Location: checkout.php");
                }else{
                    header("Location: tienda.php");
                }
                exit;
            }
        } else {
            return 'El usuario no ha sido verificado.';
        }
    }
    return 'El usuario o contraseña son incorrectos.';
}


function esActivo($usuario, $con){
    $sql = $con->prepare("SELECT activo, password FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if($row['activo']== 1){
        return true;
    }
    return false;
}

function soliPassword($user_id, $con){
    $token = generarToken();

    $sql = $con->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id =?");

    if($sql->execute([$token, $user_id])){
        return($token);
    }
    return null;
}

function verificaToken($user_id, $token, $con){
    $sql = $con->prepare("SELECT id FROM usuarios WHERE id = ? AND token_password LIKE ? AND password_request=1 LIMIT 1");
    $sql->execute([$user_id, $token]);
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
}

function actu_password($user_id, $pass_hash, $con) {
    $sql = $con->prepare("UPDATE usuarios SET password = ?, token_password = '', password_request = 0 WHERE id = ?");
    return $sql->execute([$pass_hash, $user_id]);
}
