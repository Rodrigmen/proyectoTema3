<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio08 - DWES</title>
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
             * Mostrar la dirección IP del equipo desde el que estás accediendo.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */

                echo "IP desde el que se accede: " . $_SERVER['REMOTE_ADDR']; //La dirección IP desde la que el usuario está viendo la página actual.
        ?>
        
    </body>
    
</html>       

