<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Document</title>
</head>

<body>
<header class = 'header'>
    <a href="./filas.php"><img src="../icon/atras.png" alt="atras" style = 'width: 8%; height: 60%'></a>
</header>
<?php 
include('../php/conexion.php');
$id = $_POST['id'];
$nombre = mysqli_query($conexion,"SELECT upper(nombre) from deudor WHERE id_deudor = ".$id);
// nombre///////////////////////////////////////////
if($mostrar = mysqli_fetch_array($nombre)){
?>
   <div class = 'name_perfil'><?php echo $mostrar["upper(nombre)"];?></div>
<?php
};?>
<!-- botones - y + //////////////////////////////-->
<form action="./agregar_suma.php" method = 'post'>
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input style = 'float: left;'  class ='buton_profile'  type="image" src="../icon/sumar.png" alt="Submit" > 
</form>

<form action="" method = 'post'>
    <input style = 'float: none;' class ='buton_profile'  type="image" src="../icon/resta.png" value = '<?php echo $id ?>'>
</form>
<!-- tabla ///////////////////////////////////////-->

<style type="text/css">
.tftable {width:100%;border-width: 1px;border-color: #9dcc7a;border-collapse: collapse;text-align:center;font-family: arial}
.tftable th {font-size:15px;background-color:#4472C4;border-width: 4px;padding: 8px;border-style: solid;border-color: #ffff;text-align:left;text-align:center;color:#ffff}
.tftable tr{color: black;font-size:12px} 
table tbody tr:nth-child(even) {
	background: #CFD5EA;
}
table tbody tr:nth-child(odd) {
	background: #E9EBF5;
}
.tftable td {font-size:20px;border-width:3px;padding: 10px;border-style: solid;border-color: #ffff;}
</style>
<div class="contenedorTable">
    <table class="tftable" border="1" >
    <tr><th>DEUDA</th><th>DÍAS DE ATRASO</th><th>COMENTARIO</th></tr>
    <?php
    $deuda = mysqli_query($conexion,"SELECT deuda, DATEDIFF(CURRENT_DATE,fecha), comentario from deuda WHERE id_deudor = ".$id." order by id_deuda desc");
    while($mostrar2 = mysqli_fetch_array($deuda)){
    ?>
        <tr>
            <td>$<?php echo $mostrar2["deuda"];?></td>
            <td><?php echo $mostrar2["DATEDIFF(CURRENT_DATE,fecha)"];?> Dias</td>
            <td><?php echo $mostrar2["comentario"];?></td>
        </tr>

    <?php
    };
    ?>
    </table>
</div>
<!-- total ///////////////////////////////////////-->
<table class="tftable">
    <tr>
        <th>TOTAL</th>
<?php
$total = mysqli_query($conexion,"SELECT sum(deuda) from deuda WHERE id_deudor = ".$id);
if($mostrar = mysqli_fetch_array($total)){
?>
        <th>$<?php echo $mostrar["sum(deuda)"];?></th>
    </tr>
</table>
<?php
};?>
</div>
</body>
</html>
<?php 
$conexion =null;
$deuda = null;
$nombre = null;
$total = null;
$deuda = null;
?>
