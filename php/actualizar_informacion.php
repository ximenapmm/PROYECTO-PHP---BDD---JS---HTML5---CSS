<?php
    if(
        !isset($_POST["nombrec"])||
        !isset($_POST["fecha"])||
        !isset($_POST["correo"])||
        !isset($_POST["pass"])||
        !isset($_POST["id"])
    )exit();

    include_once "../bd/base_de_datos.php";

    $id = $_POST["id"];
    $nombre = $_POST["nombrec"];
    $fecha = $_POST["fecha"];
    $email = $_POST["correo"];
    $pass = $_POST["pass"];

    $sql = $base_de_datos->prepare("UPDATE usuarios SET nombrec = ?, fecha = ?, correo = ?, pass = ? WHERE id = ?;");
    $ejecuta = $sql->execute([$nombre, $fecha, $email, $pass, $id]);

    if($ejecuta == true){
        header("refresh:0; url=menu_bienvenida.php");
    }else{
        echo "<h2>Algo salio mal, verifica que la tabla exista</h2>";
    }