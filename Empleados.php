<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/home.css">
    <!-- https://icons.getbootstrap.com/ -->
  </head>
<body >

<div class="container mt-3" background-color="#C8AE7D">
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <h1 class="text-center mt-3">Registro de Empleados</h1>
        <a href="login.html"><i class="bi bi-house"></i></a>
        <hr class="mb-3">
    </div>
    <div class="col-md-4 mb-3">
      <h3 class="text-center">Datos de Empleado</h3>
      <form method="POST" action="action.php" enctype="multipart/form-data">
        <input type="text" name="metodo" value="1" hidden>
      <div class="mb-3">
          <label class="form-label">Nombre </label>
          <input type="text" class="form-control" name="Nombre" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Apellido </label>
          <input type="text" class="form-control" name="Apellido" required>
        </div>
        <div class="mb-3">
        <label for="Genero">Genero</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="Genero" value="M" checked>
            <label class="form-check-label" for="sexoM">
              M
            </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Genero" value="F">
          <label class="form-check-label" for="sexoF">
            F
          </label>
        </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Direccion</label>
          <input type="text" name="Direccion" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Numero</label>
          <input type="number" name="Numero" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Correo</label>
          <input type="text" name="Correo" class="form-control" required>
        </div>
      
        <div class="mb-3">
          <label class="form-label">Salario</label>
          <input type="number" name="Salario" class="form-control" required>
        </div>
       
        
        <div class="mb-3">
          <label for="formFile" class="form-label">Foto</label>
          <input class="form-control" type="file" name="foto" accept="image/png,image/jpeg" required>
        </div>

        <div class="d-grid gap-2 col-12 mx-auto">
          <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
            Registrar Nuevo Empleado
            <i class="bi bi-arrow-right-circle"></i>
          </button>
        </div>
        
      </form>
    </div>


    
    <?php
    include('conexion.php');
    $sqlEmpleados   = ("SELECT * FROM Empleados ");
    $queryEmpleados = mysqli_query($Conexion, $sqlEmpleados);
    $totalEmpleados = mysqli_num_rows($queryEmpleados);

    ?>
    <div class="col-md-8">
    <h3 class="text-center">Lista de Empleados <?php echo '(' . $totalEmpleados . ')'; ?></h3>
      <div class="row">
        <div class="col-md-12 p-2">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>ID</th>
              
                  <th scope="col">Nombre </th>
                  <th scope="col">Apellido </th>
                  <th scope="col">Genero</th>
                  <th scope="col">Direccion</th>
                  <th scope="col">Numero</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Salario</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
              
              <?php
              $conteo =1;
              while ($dataEmpleados = mysqli_fetch_array($queryEmpleados)) { ?>
                <tr>
                  <td><?php echo  $conteo++ .')'; ?></td>

                  <td><?php echo $dataEmpleados['Nombre']; ?></td>
                  <td><?php echo $dataEmpleados['Apellido']; ?></td>
                  <td><?php echo $dataEmpleados['Genero']==='M' ?  'M' : 'F' ?></td>
                  <td><?php echo $dataEmpleados['Direccion']; ?></td>
                  <td><?php echo $dataEmpleados['Numero']; ?></td>
                  <td><?php echo $dataEmpleados['Correo']; ?></td>
                  <td><?php echo $dataEmpleados['Salario']; ?></td>
                  
                  
                  <td>
                  <a href="detalles.php?Id_Emp=<?php echo $dataEmpleados['Id_Emp']; ?>" class="btn btn-warning mb-2"   title="Ver datos Empleado <?php echo $dataEmpleados['Nombre']; ?>">
                  <i class="bi bi-tv"></i> Ver</a>
                    <a href="formEditar.php?Id_Emp=<?php echo $dataEmpleados['Id_Emp']; ?>" class="btn btn-info mb-2"   title="Actualizar Empleado <?php echo $dataEmpleados['Nombre']; ?>">
                    <i class="bi bi-arrow-clockwise"></i> Actualizar</a>
                    <a href="action.php?Id_Emp=<?php echo $dataEmpleados['Id_Emp']; ?>&metodo=3&namePhoto=<?php echo $dataEmpleados['foto']; ?>" class="btn btn-danger mb-2" title="Borrar Empleado <?php echo $dataEmpleados['Nombre']; ?>">
                    <i class="bi bi-trash"></i> Borrar</a>
                  </td>
                </tr>
                
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
  include('mensajes.php'); 
  $Conexion->close();
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
$(function(){
  $('.toast').toast('show');
});
</script>

</body>
</html>