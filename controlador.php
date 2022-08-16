
<div style="display: flex;
    flex-direction: column;
    align-items: center;">
<?php
/* 
Condición para validar si los parametros recibidos del formulario existen
*/
if (
    isset($_POST['nom_ap']) && isset($_POST['alias']) && isset($_POST['rut'])
    && isset($_POST['email']) && isset($_POST['region']) && isset($_POST['comuna']) &&
    isset($_POST['candidato']) && isset($_POST['candidato'])
) {
    
    $nom_ap = $_POST['nom_ap'];
    $alias = $_POST['alias'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $candidato = $_POST['candidato'];
    $tv = (isset($_POST['tv'])) ? $_POST['tv'] : 'false';
    $web = (isset($_POST['web'])) ? $_POST['web'] : 'false';
    $redes_s = (isset($_POST['redes_s'])) ? $_POST['redes_s'] : 'false';
    $amigo = (isset($_POST['amigo'])) ? $_POST['amigo'] : 'false';
}
//Condición para validar que los parametros no estén vacíos 
if (
    !empty($nom_ap) && !empty($alias) && !empty($rut) && !empty($email) && !empty($region) &&
    !empty($comuna) && !empty($candidato)
) {
    //validación que no exista rut o alias a traves de una consulta a la BD
    $error = true;
    $conexion = pg_connect("host=localhost dbname=prueba user=postgres password=admin");
    $consulta = "select * from public.persona where rut='$rut' or alias='$alias'";
    $resultado = pg_query($consulta);
    $cantidad_con = pg_num_rows($resultado);
    if ($cantidad_con == 0) {
        //ingreso de persona y votación
        $consulta = "insert into public.persona(nombre_apellido, alias, rut, email) 
                    values('$nom_ap', '$alias', '$rut', '$email') RETURNING id";
        $resultado = pg_query($consulta);
        $id_persona = pg_fetch_row($resultado);
        $consulta = "insert into public.votacion(nombre_candidato, web, tv, redes_s, amigo, persona_id_persona)
                    values('$candidato', '$web','$tv','$redes_s','$amigo', $id_persona[0])";
        $resultado = pg_query($consulta);
    }else{
        $error=false;
        echo"<h2>Ya existe un registro con el rut $rut o el alias $alias</h2>";
    }
} else {
    $error = false;
    echo "<h2>Porfavor verifique bien los datos ingresados</h2>";
}

if ($error == true) {
    echo "<h2>Registro guardado con éxito</h2>";
}
echo "<h2> Redireccionando a la pagina de inicio en 5 segundos</h2>";

?>
</div>
<script>
    setTimeout(function() {
        window.location.href = "index.php";
    }, 5000);
</script>