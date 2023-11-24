<?php include('../php/conexion.php')?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Document</title>
</head>
<body>
<header class = 'header'>
    <a href="../index.html"><img src="../icon/atras.png" alt="atras" style = 'width: 8%; height: 60%'></a>
</header>
<form action="./filas.php" method="post"  >
    <input type="text" name="busqueda"  placeholder = "buscar" class="busqueda">
</form>
<input type="image" id ="filtroicon" class='icons_busquda filtroicon' src="../icon/filtroicon.png" alt="filtro">
<form action="./filas.php" method="post"  >
    <input type="image" src="../icon/equis.png" alt = "cancel" name="busqueda" class="cancel_busquda icons_busquda" value="" id="equis">
</form>
<br><br>
<input type="image" id ="refresh" class='refreshIcon' src="../icon/refresh.png" alt="filtro">
<script>
let refresh = document.getElementById('refresh');
refresh.addEventListener('click', _ => {
        location.reload();
});
function filtroplay(){
    var contenedor = document.getElementById("contenedorFilas");
    if(contenedor.style.height != '30vh') {
        contenedor.style.height = '30vh';
        
    }else {
        contenedor.style.height = '50vh';
    };

};
function PullUp(){
    var filter = document.getElementById('filtro');
    if(filter.style.display != 'block') {
        filter.style.display = 'block';
    }else{
        filter.style.display = 'none';
        
    };
    
};
function agregarQ(){
    var agregar = document.getElementById('agregar_nuevo');
    if(agregar.style.display != 'none'){
        agregar.style.display = 'none';
    }else{
        agregar.style.display = 'block';
    };
       
        
}
document.getElementById("filtroicon").onclick = function(){
    var contenedor = document.getElementById("contenedorFilas")
    filtroplay();
    ;
    if(contenedor.style.height != '50vh'){
        PullUp()
        agregarQ()
    }else{
    setTimeout(() => {
        PullUp()
        agregarQ()
    }, 800);}
     
}
</script>
<?php
$busqueda = "";
if(isset($_POST["busqueda"])){
$busqueda = $_POST["busqueda"];
}
$orderBY = "nombre";
if(isset($_POST["filtro"])){
$orderBY = $_POST["filtro"];
}

if( $busqueda == ""){
    $orden = mysqli_query($conexion,"SELECT sum(deuda), upper(nombre), deudor.id_deudor, DATEDIFF(CURRENT_DATE,fecha) from deudor LEFT JOIN deuda ON deudor.id_deudor = deuda.id_deudor GROUP BY id_deudor ORDER BY ".$orderBY);
    echo "<script>
    function equisX(){
        var equis = document.getElementById('equis');
        equis.style.display = 'none';
    }
    equisX()
    </script>";
}else{
    $orden = mysqli_query($conexion,"SELECT sum(deuda), upper(nombre), deudor.id_deudor, DATEDIFF(CURRENT_DATE,fecha) from deudor LEFT JOIN deuda ON deudor.id_deudor = deuda.id_deudor WHERE upper(nombre) LIKE '%".$busqueda."%' GROUP BY id_deudor");
    echo "<script>
        function equisX(){
            var equis = document.getElementById('equis');
            equis.style.display = 'block';
        equisX()
        </script>";
}
?>
<div class="padre">
<div class="contenedorFilas" id="contenedorFilas">
    <?php
    while($mostrar = mysqli_fetch_array($orden)){
        if($mostrar["sum(deuda)"] == ""){
            $mostrar["sum(deuda)"] = 0;
        }
        if($mostrar["DATEDIFF(CURRENT_DATE,fecha)"] == ""){
            $mostrar["DATEDIFF(CURRENT_DATE,fecha)"] = 0;
        }
    ?> 
    <style type="text/css">
    .tablaBusqueda {width:100%;border-collapse: collapse;text-align:center;font-family: arial; border:2px solid white; color: white}
    .tablaBusqueda th {font-size:20px;background-color: #8FAADC;padding: 8px;text-align:left;text-align:center;}
    .tablaBusqueda td {font-size:15px;;padding: 10px;background-color:#8FAADC;}
    </style> 
    <tr>
        <td>
            <form action="./perfil_p.php" method="post">
            <input type="hidden" value="<?php echo $mostrar['id_deudor']?>" name="id" >
            <input type="submit" value="<?php echo $mostrar['upper(nombre)']?>" class="nombre_boton">
            </form>
        </td>

    </tr>
    <table class="tablaBusqueda">
   
    <tr>
        <td><?php echo "$".$mostrar["sum(deuda)"]?></td> 
    </tr>
    <tr>
        <td><?php echo $mostrar["DATEDIFF(CURRENT_DATE,fecha)"]."-D atrasado"?></td>
    </tr>
    </table>
    
    <?php
    }
    ?>
</div>


<div class='filtro' id='filtro'>
<table>
    <form action="./filas.php" method = "post">
        <div class= "orden">ORDEN</div><br>
        <tr><input name="filtro" class="OpFiltro" type = "radio" value = "nombre asc"> NOMBRE A-Z<br></tr>
        <tr><input name="filtro" class="OpFiltro" type = "radio" value = "nombre desc"> NOMBRE Z-A<br></tr>
        <tr><input name="filtro" class="OpFiltro" type = "radio" value = "sum(deuda) desc"> MAS DEBE<br></tr>
        <tr><input name="filtro" class="OpFiltro" type = "radio" value = "sum(deuda) asc"> MENOS DEBE<br></tr>
        <tr><input name="filtro" class="OpFiltro" type = "radio" value = "DATEDIFF(CURRENT_DATE,fecha) desc"> MAS DIAS DE ATRASO<br></tr>
        <tr><input name="filtro" class="OpFiltro" type = "radio" value = "DATEDIFF(CURRENT_DATE,fecha) asc"> MENOS DIAS DE ATRASO<br></tr>
        <tr><input type="submit" value="ORDENAR" class="OpFiltro"></tr>

</table>
</div>
</div>
</form>
<a href="./form_deudor.html" id="agregar_nuevo"><img src="../icon/agregar.png" alt=""  class= "agregar_nuevo"></a>
</body>
</html>