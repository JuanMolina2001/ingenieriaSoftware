<?php include('conexion.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    $sql = "INSERT INTO deudor (id_deudor, nombre) VALUES (NULL, '$nombre')";

    if($conexion->query($sql) == true){ 
        $resultado = mysqli_query($conexion,"SELECT MAX(id_deudor) FROM deudor;");
        if($mostrar = mysqli_fetch_array($resultado)){
            $id = $mostrar['MAX(id_deudor)'];
        }
         
        echo '<p class="ingresando">INGRESANDO</p><div><img src="../icon/loading.gif" alt="cargando" class="loading"></div>
        <form name = "form_deudor" action="../subpage/perfil_p.php" method="post">
            <input type="hidden"  name="id" value="'.$id.'">
        </form>
        <script>
            
            window.onload=function(){
                document.forms["form_deudor"].submit();
            }
        </script>';
    }else{
        die("Error en la conexión si esto continua por favor pónganse en contacto con el soporte e indíquele el error a continuación: ".$conexion->error);
    }

}
?>
</body>
</html>
<?php
$conexion = null;
$sql = null;
$resultado = null
?>
    

