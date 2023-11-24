<?php
include("./conexion.php");
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $comentario = $_POST['comentario'];
    $monto = $_POST['monto'];

    $sql = "INSERT INTO `deuda` (`id_deuda`, `deuda`, `fecha`, `comentario`, `id_deudor`) VALUES (NULL, '$monto', current_timestamp(), '$comentario', '$id');";
    if($conexion->query($sql) == true){  
        echo '<p class="ingresando">INGRESANDO</p><div><img src="../icon/loading.gif" alt="cargando" class="loading"></div>
        <form name = "form_deudor" action="../subpage/perfil_p.php" method="post">
            <input type="hidden"  name="id" value="'.$_POST['id'].'">
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

$conexion = null;
$sql = null
?>
