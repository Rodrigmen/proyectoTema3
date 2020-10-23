<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio22 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
         <style>
             body{
                 background-color: #A9C6FF;
             }
         </style>
    </head>
    <body>
        <?php
            /**
             * Construir un formulario para recoger un cuestionario realizado a una persona y mostrar en la misma página 
             * las preguntas y las respuestas recogidas.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            if(isset($_POST['submit'])){
                $nombre = $_POST['nombre'];
                $edad = (int)$_POST['edad'];
        ?>
                <p>Hola <?php echo $nombre; ?>.</p>
                <p> Usted tiene <?php echo $edad; ?> años.</p>
        <?php
            }else{
        ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Formulario Personal</legend>
                        <p>
                            <label for="nombre">Su nombre: </label>
                            <input type="text" name="nombre" />
                        </p>
                        <p>
                            <label for="edad">Su edad:</label> 
                            <input type="text" name="edad" />
                        </p>
                        <p><input type="submit" name="submit" value="Enviar" /></p>
                    </fieldset>
                </form>
        <?php   
             }
        ?>
        
    </body>
    
</html>       

