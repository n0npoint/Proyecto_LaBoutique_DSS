<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./Styles/Empleado.css">
    <title>Empleados</title>
    <?php  
require_once('conexion.php');
?>
    
</head>
<body>
  <div id="main-container">
    <table class="table">
      <thead class="thead-light">
      <tr>
      <th scope="col">Id_Emp</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Genero</th>
      <th scope="col">Direccion</th>
      <th scope="col">Numero</th>
      <th scope="col">Correo</th>
      <th scope="col">Salario</th>
    </tr>
  
      </thead>
      <tbody>
      <?php
    $sql = "SELECT * FROM Empleados";
    $result = mysqli_query($Conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Id_Emp'] . "</td>";
            echo "<td>" . $row['Nombre'] . "</td>";
            echo "<td>" . $row['Apellido'] . "</td>";
            echo "<td>" . $row['Genero'] . "</td>";
            echo "<td>" . $row['Direccion'] . "</td>";
            echo "<td>" . $row['Numero'] . "</td>";
            echo "<td>" . $row['Correo'] . "</td>";
            echo "<td>" . $row['Salario'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No se encontraron registros.";
    }
    ?>
      </tbody>
    </table>
  </div>
   
     
</body>
</html>