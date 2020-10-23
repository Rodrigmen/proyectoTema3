<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio16 - DWES</title>
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
             * Recorrer el array anterior utilizando funciones para obtener el mismo resultado.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */

            $aSemana=[
                 'Lunes'=>50,
                 'Martes'=>75,
                 'Miércoles'=>100,
                 'Jueves'=>75,
                 'Viernes'=>50,
                 'Sábado'=>25,
                 'Domingo'=>0
             ];
            
            echo '<b>array_walk: </b><br>';
            function sueldoSemana($sueldo, $dia){
                echo  "$dia: $sueldo  €<br>";
            }
            array_walk($aSemana, 'SueldoSemana');
            
            echo '<br><br><b>print_r: </b>';
            print_r($aSemana);
            
            echo '<br><br><b>print_r + array_values: </b>';
            print_r(array_values($aSemana));
                        
            echo '<br><br><b>print_r + array_keys: </b>';
            print_r(array_keys($aSemana));
                        
            echo '<br><br><b>var_dump: </b>';
            echo var_dump($aSemana);
            
            
            
            
            
        ?>
        
    </body>
    
</html>       

