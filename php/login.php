<?php
session_start(); /*Creamos sesiones de trabajo*/
?>
<?php
$correo = $_POST['user'];
$pass = $_POST['password'];

$conexion = mysqli_connect("localhost","root","","proyecto");
$consulta = "SELECT *
             FROM usuarios
             WHERE correo = '$correo'
             AND pass = '$pass'";

$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);

if($filas>0){
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $correo;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60); //10 minutos
if($correo == TRUE){
    header("location:menu_bienvenida.php");
}
}
else{
    header("Refresh:0; url=login.html");
}
mysqli_free_result($resultado);
mysqli_close($conexion);