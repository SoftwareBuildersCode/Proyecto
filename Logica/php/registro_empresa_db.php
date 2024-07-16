<?php

    include 'conexion_bd.php';

    $nombre_empresa = $_POST['nombre_empresa'];
    $correo = $_POST['correo'];
    $RUT= $_POST['RUT'];
    $contrasena = $_POST['contrasena'];

    // Verificar que todos los campos estén llenos
    if (empty($nombre_empresa) || empty($correo) || empty($RUT) || empty($contrasena)) {
        echo '
            <script>
                alert("Todos los campos son obligatorios.");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }
    $query = "INSERT INTO empresas(nombre_empresa, correo, RUT, contrasena)
    VALUES('$nombre_empresa','$correo','$RUT','$contrasena')";

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM empresas WHERE correo='$correo'");
    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya está registrado, use uno diferente.");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

    $verificar_RUT = mysqli_query($conexion, "SELECT * FROM empresas WHERE RUT='$RUT'");
    
    if(mysqli_num_rows($verificar_RUT) > 0){
        echo '
            <script>
                alert("Este RUT ya está registrado, use uno diferente.");
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
                window.location = "../gestionProductos/gestion_productos.html";
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
