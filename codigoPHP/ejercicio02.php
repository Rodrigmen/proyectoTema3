<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio02 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg"/> 
         <style>
             body{
                 background-color: #A9C6FF;
             }
         </style>
         
    </head>
    <body>
        <?php
            /**
             * Inicializar y mostrar una variable heredoc.
             * 
             * @version 2.0.0
             * @since 23-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
            
        //Heredoc se comporta de la misma forma que las comillas dobles pero tiene una sintaxis diferente.
            $saludo = <<<EOD
                    HOLA, ESTE
                    ES
                    EL EJERCICIO
                    2
EOD;
            
            echo $saludo;
        ?>
        
    </body>
    
</html>       