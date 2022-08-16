<?php

$conexion = pg_connect("host=localhost dbname=prueba user=postgres password=admin");
$nombre_consulta= $_POST['tipo_consulta'];
//Condición para obtener la region de la BD y la comuna segun su región
switch($nombre_consulta){
    case 'obtener_region':
        $consulta="select nombre, id from public.region";
        $resultado=pg_query($conexion, $consulta);
        echo "<option value=''>Seleccione región</option>";
        while($row=pg_fetch_row($resultado)){
            echo "<option value='$row[1]'>$row[0]</option>";
        }  
        break;
    case 'obtener_comuna':
        $id_region=$_POST['id_region'];
        $consulta="select nombre, id from public.comuna where region_id_region=$id_region";
        $resultado=pg_query($conexion, $consulta);
        echo "<option value=''>Seleccione comuna</option>";
        while($row=pg_fetch_row($resultado)){
            echo "<option value='$row[1]'>$row[0]</option>";
        }  
        break;
}



?>