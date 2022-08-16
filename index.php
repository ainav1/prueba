<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Script para importar la libreria jquery-->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Script para importar los estilos-->
    <link rel="stylesheet" href="CSS/estilos.css">
    <title>Formulario de votación</title>
</head>

<body>
    <form method="POST" action="controlador.php" id="formulario">
        <h1>Formulario de votación</h1>
        <table>
            <tr>
                <td>Nombre y Apellido: </td>
                <td><input type="text" id="nom_ap" name="nom_ap"></td>
            </tr>
            <tr>
                <td>Alias</td>
                <td><input type="text" id="alias" name="alias" require="require"></td>
            </tr>
            <tr>
                <td>RUT</td>
                <td><input type="text" name="rut" id="rut" ></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <td>Región</td>
                <td><select name="region" id="region">
                        <option value="">Seleccione región</option>
                    </select></td>
            </tr>
            <tr>
                <td>Comuna</td>
                <td><select name="comuna" id="comuna">
                        <option value="">Seleccione comuna</option>
                    </select></td>
            </tr>
            <tr>
                <td>Candidato</td>
                <td><select name="candidato" id="candidato">
                        <option value="">Seleccione candidato</option>
                        <option value="Jordan Alvarez">Jordan Alvarez</option>
                        <option value="Pedro Lopez">Pedro Lopez</option>
                        <option value="Juan Jimenez">Juan Jimenez</option>
                    </select></td>
            </tr>
            <tr>
                <td>Como se entero de nosostros</td>
                <td>
                    <input type="checkbox" name="web" id="web">Web
                    <input type="checkbox" name="tv" id="tv">Tv
                    <input type="checkbox" name="redes_s" id="redes_s">Redes Sociales
                    <input type="checkbox" name="amigo" id="amigo">Amigo
                </td>
            </tr>

            <tr>
                <td>
                    <br>
                    <input type="submit" name="b_votar" id="b_votar" value="Votar">
                </td>
            </tr>



        </table>

    </form>
</body>
<script src="JS/validaciones.js"></script>
</html>