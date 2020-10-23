<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio07 - DWES</title>
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
             * Mostrar el nombre del fichero que se está ejecutando.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */

            echo 'El archivo actual es: '.basename($_SERVER['PHP_SELF']); //basename devuelve el último componente de nombre de una ruta
            
        ?>
        
    </body>
    
</html>       

