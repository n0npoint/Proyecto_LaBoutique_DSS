<?php
include('conexion.php');
date_default_timezone_set("America/Tegucigalpa");
setlocale(LC_ALL, 'es_ES');

$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);

//$metodoAction ==1, es crear un registro nuevo
if($metodoAction == 1){

    
    $Nombre       = filter_var($_POST['Nombre'], FILTER_SANITIZE_STRING);
    $Apellido       = filter_var($_POST['Apellido'], FILTER_SANITIZE_STRING);
    $Genero           = filter_var($_POST['Genero'], FILTER_SANITIZE_STRING);
    $Direccion           = filter_var($_POST['Direccion'], FILTER_SANITIZE_STRING);
    $Numero         = (int) filter_var($_POST['Numero'], FILTER_SANITIZE_NUMBER_INT);
    $Correo       = filter_var($_POST['Correo'], FILTER_SANITIZE_STRING);
    $Salario         = (int) filter_var($_POST['Salario'], FILTER_SANITIZE_NUMBER_INT);

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
        $SqlInsertEmpleados = ("INSERT INTO Empleados(
            Nombre,
            Apellido,
            Genero,
            Direccion,
            Numero,
            Correo,
            Salario,
            foto
        )
        VALUES(
            '".$Nombre."',
            '".$Apellido."',
            '".$Genero."',
            '".$Direccion."',
            '".$Numero."',
            '".$Correo."',
            '".$Salario."',
            '".$foto."'
           

        )");
        $resulInsert = mysqli_query($Conexion, $SqlInsertEmpleados);


    }
    closedir($miDir);
    header("Location:Empleados.php?a=1");

  }else{
    header("Location:Empleados.php?errorimg=1");
  }
}


//Actualizar registro del Empleados
if($metodoAction == 2){
    $idEmpleados       =  (int)filter_var($_REQUEST['Id_Emp'], FILTER_SANITIZE_NUMBER_INT);
    $Nombre       = filter_var($_POST['Nombre'], FILTER_SANITIZE_STRING);
    $Apellido       = filter_var($_POST['Apellido'], FILTER_SANITIZE_STRING);
    $Genero       = filter_var($_POST['Genero'], FILTER_SANITIZE_STRING);
    $Direccion       = filter_var($_POST['Direccion'], FILTER_SANITIZE_STRING);
    $Numero         = (int) filter_var($_POST['Numero'], FILTER_SANITIZE_NUMBER_INT);
    $Correo       = filter_var($_POST['Correo'], FILTER_SANITIZE_STRING);
    $Salario         = (int) filter_var($_POST['Salario'], FILTER_SANITIZE_NUMBER_INT);
   

    $UpdateEmpleados    = ("UPDATE Empleados
        SET Nombre='$Nombre',
        Apellido='$Apellido', 
        Genero='$Genero',
        Direccion='$Direccion',
        Numero='$Numero',   
        Correo='$Correo', 
        Salario='$Salario'
        WHERE Id_Emp='$idEmpleados' ");
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
            $updateFoto = ("UPDATE Empleados SET foto='$foto' WHERE Id_Emp='$idEmpleados' ");
            $resultFoto = mysqli_query($Conexion, $updateFoto);
        }
    }else{
        header("Location:Empleados.php?errorimg=1");
    }
  }

  header("Location:formEditar.php?update=1&Id_Emp=$idEmpleados");
 }



//Eliminar Alumno
if($metodoAction == 3){
    $idEmpleados  = (int) filter_var($_REQUEST['Id_Emp'], FILTER_SANITIZE_NUMBER_INT);
    $namePhoto = filter_var($_REQUEST['namePhoto'], FILTER_SANITIZE_STRING);

    $SqlDeleteEmpleados = ("DELETE FROM Empleados WHERE  Id_Emp='$idEmpleados'");
    $resultDeleteEmpleados = mysqli_query($Conexion, $SqlDeleteEmpleados);
    
    if($resultDeleteEmpleados !=0){
        $fotoEmpleados= "fotosAlumnos/".$namePhoto;
        unlink($fotoEmpleados);
    }
    
    $msj ="Empleados Deshabilitado correctamente.";
    header("Location:Empleados.php?deletEmpleados=1&mensaje=".$msj);
 
}

?>