<?php
if(!isset($_POST["nombrec"]) ||
   !isset($_POST["fecha"]) ||
   !isset($_POST["correo"]) ||
   !isset($_POST["pass"])
)exit();

include_once "../bd/base_de_datos.php"; //include_once solamente se ejecuta una vez
$usuario = $_POST["nombrec"];
$fecha = $_POST["fecha"];
$correo = $_POST["correo"];
$password = $_POST["pass"];

$insertar = $base_de_datos->prepare("INSERT INTO usuarios (nombrec,fecha,correo,pass) VALUES (?,?,?,?);");
$resultado_insertar = $insertar->execute([$usuario, $fecha, $correo, $password]);

if($resultado_insertar === TRUE){
    echo "
    <script>
        alert('Tu cuenta ha sido creada con exito...');
    </script>";
    header("Refresh:0; url=login.html");
   
}else{
echo "
    <script>
        alert('¡Error de formulario!...');
        alert('¡Error de conexión a base de datos!');
    </script>";
    header("Refresh:0; url=crear_cuenta.html");
}
?>