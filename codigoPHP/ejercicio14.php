<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio14-19 - DWES</title>
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
             * Comprobar las librerías que estás utilizando en tu entorno de desarrollo y explotación. 
             * Crear tu propia librería de funciones y estudiar la forma de usarla en el entorno de desarrollo y en el de explotación.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
           
        
            require_once '../core/misFunciones.php';
            
            echo '<p>Función suma (15 y 20): '. SumaNumeros(15, 20).'</p>';
            echo '<p>Función resta (15 y 20): '. RestaNumeros(15, 20).'</p>';
            echo '<p>Función multiplicación (15 y 20): '. MultNumeros(15, 20).'</p>';
            echo '<p>Función división (15 y 20): '. DivNumeros(15, 20).'</p>';
            echo '<p>Función módulo (15 y 20): '. ModuloNumeros(15, 20).'</p>';

        ?>
        
    </body>
    
</html>       

