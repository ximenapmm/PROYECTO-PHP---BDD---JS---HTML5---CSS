<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

}else{
    echo "<script> alert('Debes de iniciar sesión.'); </script>";
    header("Refresh:0; url=login.html");
exit;
}
$now = time();

if($now > $_SESSION['expire']) {
    session_destroy(); //destruyendo la variable session_start();
    header("Refresh:0; url=login.html");
exit;
}
?>
<!-- Documento de seleccionar la tabla de datos -->
<?php
include_once "../bd/base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuarios;");
$solicitudes = $sentencia->fetchALL(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hoja_estilo.css">
    <link rel="icon" href="../images/icono-pagina.png">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <title><?php echo "Administrador: " .$_SESSION['user'];?></title>
</head>
<body>
<script src="../js/imagen.js"></script>
<script src="../js/logout.js"></script>
<div class="content">
    <img src="../images/5.jpg" class="logo">
</div>
<div class="content2">
    <div class="nav-bg">
        <nav class="navegacion-principal">
            <a href="cerrar_sesion.php" class="enlace-logout" onclick="cerrar_sesion()">Cerrar Sesión</a>
        </nav>
    </div>
    <h2 class="usuarios-registrados">Administradores Registrados</h2>
    <div class="menu-bienvenida">
        <a href="menu_bienvenida.php" class="registrar-admin">Actualizar</a>
        <a href="#" class="registrar-admin" >Registrar Administrador</a>
    </div>
    <br><br>
        <table>
            <thead>
                <tr>
                    <td>No. Identificador</td>
                    <td>Nombre Completo</td>
                    <td>Fecha</td>
                    <td>Correo</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($solicitudes as $solicitud){ ?>
                <tr>
                    <td><?php echo $solicitud->id ?></td>
                    <td><?php echo $solicitud->nombrec ?></td>
                    <td><?php echo $solicitud->fecha ?></td>
                    <td><?php echo $solicitud->correo ?></td>
                    <td><a href="<?php echo "editar_admin.php?id=" . $solicitud->id?>"><div><img src="../images/editar-usuario.png" class="imagen-boton"></div></a></td>
                    <td><a href="<?php echo "eliminar_admin.php?id=" . $solicitud->id?>"><div><img src="../images/eliminar-usuario.png" class="imagen-boton"></div></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
</div>
</body>
</html>