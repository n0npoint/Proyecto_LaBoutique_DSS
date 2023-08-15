<?php
include('conexion.php');
date_default_timezone_set("America/Tegucigalpa");
setlocale(LC_ALL, 'es_ES');

$metodoAction  = (int) filter_var($_REQUEST['metodos'], FILTER_SANITIZE_NUMBER_INT);

//$metodoAction ==1, es crear un registro nuevo
if($metodoAction == 1){

    
    $Nombre       = filter_var($_POST['Nombre'], FILTER_SANITIZE_STRING);
    $Apellido       = filter_var($_POST['Apellido'], FILTER_SANITIZE_STRING);
    $Numero         = (int) filter_var($_POST['Numero'], FILTER_SANITIZE_NUMBER_INT);
   

    //Informacion de la foto
    $filename       = $_FILES["foto"]["name"]; //nombre de la foto
    $tipo_foto      = $_FILES['foto']['type']; //tipo de archivo
    $sourceFoto     = $_FILES["foto"]["tmp_name"]; //url temporal de la foto
    $tamano_foto    = $_FILES['foto']['size']; //tamaño del archivo (foto)

//Se comprueba si la foto a cargar es correcto observando su extensión y tamaño, 100000 = 1 Mega 
if (!((strpos($tipo_foto, "PNG") || strpos($tipo_foto, "jpg") && ($tamano_foto < 100000)))) {
    //código para renombrar la foto 
    $logitudPass 	        = 8;
    $newNameFoto            = substr( md5(microtime()), 1, $logitudPass);
    $explode                = explode('.', $filename);
    $extension_foto         = array_pop($explode);
    $foto          = $newNameFoto.'.'.$extension_foto;

    //Verificando si existe el directorio, de lo contrario lo creo
    $dirLocal       = "fotosAlumnos";
    if (!file_exists($dirLocal)) {
        mkdir($dirLocal, 0777, true);
    }

    $miDir 		      = opendir($dirLocal); //Habro mi  directorio
    $urlFotoEmpleados    = $dirLocal.'/'.$foto; //Ruta donde se almacena la factura.

    //Muevo la foto a mi directorio.
    if(move_uploaded_file($sourceFoto, $urlFotoEmpleados)){
        $SqlInsertClien = ("INSERT INTO Clientes(
            Nombre,
            Apellido,
            Telefono,
            foto
        )
        VALUES(
            '".$Nombre."',
            '".$Apellido."',
            '".$Numero."',
            '".$foto."'
           

        )");
        $resulInsert = mysqli_query($Conexion, $SqlInsertClien);


    }
    closedir($miDir);
    header("Location:Clientes.php?a=1");

  }else{
    header("Location:Clientes.php?errorimg=1");
  }
}


//Actualizar registro del Empleados
if($metodoAction == 2){
    $idClientes      =  (int)filter_var($_REQUEST['id_cliente'], FILTER_SANITIZE_NUMBER_INT);
    $Nombre       = filter_var($_POST['Nombre'], FILTER_SANITIZE_STRING);
    $Apellido       = filter_var($_POST['Apellido'], FILTER_SANITIZE_STRING);
    $Numero         = (int) filter_var($_POST['Telefono'], FILTER_SANITIZE_NUMBER_INT);
   

    $UpdateEmpleados    = ("UPDATE Clientes
        SET Nombre='$Nombre',
        Apellido='$Apellido', 
        Telefono='$Numero'   
        WHERE id_cliente='$idClientes' ");
    $resultadoUpdate = mysqli_query($Conexion, $UpdateEmpleados);


    //Verificando si existe foto del alumno para actualizar
    if (!empty($_FILES["foto"]["name"])){
            $filename       = $_FILES["foto"]["name"]; //nombre de la foto
            $tipo_foto      = $_FILES['foto']['type']; //tipo de archivo
            $sourceFoto     = $_FILES["foto"]["tmp_name"]; //url temporal de la foto
            $tamano_foto    = $_FILES['foto']['size']; //tamaño del archivo (foto)

            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo_foto, "PNG") || strpos($tipo_foto, "jpg") && ($tamano_foto < 100000)))) {
            $logitudPass 	        = 8;
            $newNameFoto            = substr( md5(microtime()), 1, $logitudPass);
            $explode                = explode('.', $filename);
            $extension_foto         = array_pop($explode);
            $foto          = $newNameFoto.'.'.$extension_foto;

            //Verificando si existe el directorio, de lo contrario lo creo
            $dirLocal       = "fotosAlumnos";
            $miDir 		      = opendir($dirLocal); //Habro mi  directorio
            $urlFotoEmpleados   = $dirLocal.'/'.$foto; //Ruta donde se almacena la factura.

            //Muevo la foto a mi directorio.
        if(move_uploaded_file($sourceFoto, $urlFotoEmpleados)){
            $updateFoto = ("UPDATE Clientes SET foto='$foto' WHERE id_cliente='$idClientes' ");
            $resultFoto = mysqli_query($Conexion, $updateFoto);
        }
    }else{
        header("Location:Clientes.php?errorimg=1");
    }
  }

  header("Location:formEditarC.php?update=1&id_cliente=$idClientes");
 }



//Eliminar Cliente
if($metodoAction == 3){
    $idEmpleados  = (int) filter_var($_REQUEST['id_cliente'], FILTER_SANITIZE_NUMBER_INT);
    $namePhoto = filter_var($_REQUEST['namePhoto'], FILTER_SANITIZE_STRING);

    $SqlDeleteEmpleados = ("DELETE FROM Clientes WHERE id_cliente ='$idClientes'");
    $resultDeleteEmpleados = mysqli_query($Conexion, $SqlDeleteEmpleados);
    
    if($resultDeleteEmpleados !=0){
        $fotoEmpleados= "fotosAlumnos/".$namePhoto;
        unlink($fotoEmpleados);
    }
    
    $msj ="Cliente Borrado correctamente.";
    header("Location:Clientes.php?deletEmpleados=1&mensaje=".$msj);
 
}

?>