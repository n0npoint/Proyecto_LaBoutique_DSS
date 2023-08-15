<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/home.css">
    <!-- https://icons.getbootstrap.com/ -->
  </head>
<body>
    
<div class="container mt-3">
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <h1 class="text-center mt-3">
        <a href="Empleados.php">
          <i class="bi bi-arrow-left-circle"></i>
        </a>
        Actualizar Datos del Empleado 
      </h1>
      <hr class="mb-3">
    </div>


    
    <?php
    include('conexion.php');
    $idEmpleados    = (int) filter_var($_REQUEST['Id_Emp'], FILTER_SANITIZE_NUMBER_INT);
    $sqlEmpleados   = ("SELECT * FROM Empleados WHERE Id_Emp='$idEmpleados' LIMIT 1");
    $queryEmpleados = mysqli_query($Conexion, $sqlEmpleados);
    $dataEmpleados  = mysqli_fetch_array($queryEmpleados);
    ?>

    <div class="col-md-5 mb-3">
      <h3 class="text-center">Datos de Empleado</h3>
      <form method="POST" action="action.php?metodo=2" enctype="multipart/form-data">
      <input type="text" name="Id_Emp" value="<?php echo $dataEmpleados['Id_Emp']; ?>" hidden>
      <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" name="Nombre" value="<?php echo $dataEmpleados['Nombre']; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Apellido</label>
          <input type="text" class="form-control" name="Apellido" value="<?php echo $dataEmpleados['Apellido']; ?>">
        </div>
        <div class="mb-3">
        <label for="Genero">Genero</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="Genero" value="M" <?php echo $dataEmpleados['Genero']==='M' ?  'checked' : '' ?> checked>
            <label class="form-check-label" for="sexoM">
              M
            </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Genero" value="F" <?php echo $dataEmpleados['Genero']==='F' ?  'checked' : '' ?>>
          <label class="form-check-label" for="sexoF">
            F
          </label>
        </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Direccion</label>
          <input type="text" class="form-control" name="Direccion" value="<?php echo $dataEmpleados['Direccion']; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Numero</label>
          <input type="number" name="Numero" class="form-control" value="<?php echo $dataEmpleados['Numero']; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Correo</label>
          <input type="text" class="form-control" name="Correo" value="<?php echo $dataEmpleados['Correo']; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Salario</label>
          <input type="number" name="Salario" class="form-control" value="<?php echo $dataEmpleados['Salario']; ?>">
        </div>
        

        <div class="mb-3">
          <label for="formFile" class="form-label">Foto de Empleado</label>
          <input class="form-control" type="file" name="foto" accept="image/png,image/jpeg">
        </div>

        <div class="d-grid gap-2 col-12 mx-auto">
          <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
            Actualizar datos de Empleado
            <i class="bi bi-arrow-right-circle"></i>
          </button>
        </div>
        
      </form>
    </div>

    <div class="col-md-5 mb-3">
        <label class="form-label">Foto actual de Empleado</label>
        <br>
        <img src="fotosAlumnos/<?php echo $dataEmpleados['foto']; ?>" alt="foto perfil" class="card-img-top fotoPerfil">
    </div>



  </div>
</div>

<?php
  include('mensajes.php'); 
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
$(function(){
  $('.toast').toast('show');
});
</script>

</body>
</html>