<?php
$Servidor = "sql9.freesqldatabase.com";
$Usuario = "sql9638269";
$Password = "qUHzSj2di7";
$DB = "sql9638269";

$Conexion = mysqli_connect($Servidor, $Usuario, $Password, $DB);

if($Conexion){
   
}else{
    echo '<script>alert("No fue posible establecer conexión el servidor sql!")</script>';
}
?>