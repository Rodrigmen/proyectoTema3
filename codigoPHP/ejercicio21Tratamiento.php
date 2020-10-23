<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio21 - DWES</title>
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
             * Es la página de respuesta del formulario del ejercicio 21.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
        //La variable $_POST['name del input'] recupera la información insertada en el input del formulario, y la mostramos mediante el echo
        
            echo '<p>Hola '. $_POST['nombre'].'.</p>'.
             '<p>Usted tiene '. (int)$_POST['edad'].' años.</p>';
        ?>
    </body>
    
</html>       

