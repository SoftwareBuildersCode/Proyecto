<?php

    session_start();
    include 'conexion_bd.php';

    $correo = $_POST['correo'];
    $contasena = $_POST['contrasena'];
    

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'
    and contrasena = '$contasena'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $correo;
        header("location: ../tienda.html");
    }else{
        echo'
            <script>
                alert("Usuario no existnte");
                window.location = "../login.php";
            </script>
        ';
    }
    $validar_login = mysqli_query($conexion, "SELECT * FROM empresas WHERE correo='$correo'
    and contrasena = '$contasena'");
    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['empresas'] = $correo;
        header("location: ../gestionProductos/gestion_productos.html");
    }else{
        echo'
            <script>
                alert("Usuario no existnte");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

?>