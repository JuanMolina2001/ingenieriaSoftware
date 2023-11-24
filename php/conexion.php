<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conexion = new mysqli('bbnaedsrpbwlooarebdt-mysql.services.clever-cloud.com','ukshhdiemaiw8bip','lLjO3gSWlHn5WARVWlMO','bbnaedsrpbwlooarebdt');

if($conexion->connect_error){
    die("Error en la conexión si esto continua por favor pónganse en contacto con el soporte e indíquele el error a continuación: " . $conexion->connect_error);
}
?>
