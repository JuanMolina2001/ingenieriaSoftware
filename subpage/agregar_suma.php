<?php
$id = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
    <form action="../php/sumar.php" method="post">
        <p class='text_in_mid'>INGRESE UN MONTO</p>
        <input class="ingresar_texto" type="number" name="monto" required >
        <p class='text_in_mid'>AGREGRE UN COMENTARIO (OPCIONAL)</p>
        <input class="ingresar_texto" type="text" placeholder="Mayonesa" name="comentario" >
        <input type="hidden" value="<?php echo $id?>" name ="id">
        <div class='contenedor'><input type="submit" value="ACEPTAR" class="aceptBtn"></div>
    </form>
    <br><br>
    
    <div class='contenedor'><input type="button" value="cancelar" onClick="history.go(-1);" class='cancelBtn'></div>

</body>
</html>
