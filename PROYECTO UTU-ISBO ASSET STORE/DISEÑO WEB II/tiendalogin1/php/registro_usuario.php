<?php

    include 'conexion_bd.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar que todos los campos estén llenos
    if (empty($nombre_completo) || empty($correo) || empty($usuario) || empty($contrasena)) {
        echo '
            <script>
                alert("Todos los campos son obligatorios.");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena)
    VALUES('$nombre_completo','$correo','$usuario','$contrasena')";

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
    
    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya está registrado, use uno diferente.");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");
    
    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("Este usuario ya está registrado, use uno diferente.");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion,$query);
    
    if($ejecutar){
        echo '
            <script>
                alert("Usuario registrado exitosamente.");
                window.location = "../tienda.html";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Error, intente de nuevo.");
                window.location = "../login.php";
            </script>
        ';
    }

    mysqli_close($conexion);

?>
