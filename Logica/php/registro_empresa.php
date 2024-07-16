<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../css/regist_empresa.css">
</head>
<body>
    <div>
        <form action="registro_empresa_db.php" method="POST" class="formulario__register">
            <h2>Regístrarse</h2>
            <input type="text" placeholder="Nombre Empresa" name="nombre_empresa">
            <input type="text" placeholder="Correo Electronico" name="correo">
            <input type="text" placeholder="RUT" name="RUT">
            <input type="password" placeholder="Contraseña" name="contrasena">
            <button>Regístrarse</button>
        </form>
    </div>
</body>
</html>
