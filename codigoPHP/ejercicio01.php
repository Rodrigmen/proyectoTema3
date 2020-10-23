<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio01 - DWES</title>
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
             * Inicializar variables de los distintos tipos de datos básicos
             * (string, int, float, bool) y mostrar los datos por pantalla (echo, print, printf, print_r, var_dump).
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
           
        /*VARIABLES INICIALIZADAS*/
            $entero = 4;  
            $decimal = 5.5;
            $boolean = true;
            $cadena = "Es una cadena de texto";
            
        /*DATOS POR PANTALLA*/
            //ECHO (Muestra una o más cadenas)
            echo "<b>ECHO (Muestra una o más cadenas)</b><br><br>"
            . "STRING: $cadena<br>"
            . "ENTERO: $entero<br>"
            . "FLOAT: $decimal<br>"
            . "BOOLEAN: $boolean<br><br><br>";
            
            //PRINT (Mostrar una cadena)
            print "<b>PRINT (Mostrar una cadena)</b><br><br>"
            . "STRING: $cadena<br>"
            . "ENTERO: $entero<br>"
            . "FLOAT: $decimal<br>"
            . "BOOLEAN: $boolean<br><br><br>";
            
            //PRINTF (Imprimir una cadena con formato)
            printf("<b>PRINTF (Imprimir una cadena con formato)</b><br><br>"
            . "STRING: $cadena<br>"
            . "ENTERO: $entero<br>"
            . "FLOAT: $decimal<br>"
            . "BOOLEAN: $boolean<br><br><br>");
            
            //PRINT_R (Imprime información legible para humanos sobre una variable)
            print_r("<b>PRINT_R (Imprime información legible para humanos sobre una variable)</b><br><br>"
            . "STRING: $cadena<br>"
            . "ENTERO: $entero<br>"
            . "FLOAT: $decimal<br>"
            . "BOOLEAN: $boolean<br><br><br>");
            
            //VAR_DUMP (Muestra información sobre una variable)
            echo "<b>VAR_DUMP (Muestra información sobre una variable)</b><br><br>";
            var_dump("<b>VAR_DUMP</b><br><br>"
            . "STRING: $cadena<br>"
            . "ENTERO: $entero<br>"
            . "FLOAT: $decimal<br>"
            . "BOOLEAN: $boolean<br><br><br>");
            
             
        ?>
        
    </body>
    
</html>       

