<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio15 - DWES</title>
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
             * Crear e inicializar un array con el sueldo percibido de lunes a domingo. 
             * Recorrer el array para calcular el sueldo percibido durante la semana. (Array asociativo con los nombres de los días de la semana).
             * 
             * @version 2.0.0
             * @since 22-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            /*CONTANTE (el número de dias de una semana)*/
            define("NDIAS", 7);
            
            /*CREACIÓN E INICIALIZACIÓN del array || aSemana[dia]=>sueldodia*/
            for ($dia = 1; $dia <= NDIAS; $dia++) {
                $aSemana[$dia]= null;
            }
        
            /*Insertamos tanto el nombre de los días de la semana como sus respectivos sueldos*/
            $aSemana=[
                'Lunes'=>50,
                'Martes'=>75,
                'Miércoles'=>100,
                'Jueves'=>75,
                'Viernes'=>50,
                'Sábado'=>25,
                'Domingo'=>0
            ];
            
            //Iniciamos a 0 el acumulador de sueldo, el cual nos mostrara al final el sueldo total por semana
            $acumulador=0;
            echo '<h3>Sueldo por dia: </h3>';
            foreach ($aSemana as $dia => $sueldoDia){
                 echo "$dia: $sueldoDia €<br>";
                 $acumulador+=$sueldoDia;
            }
            
            echo "<br><b>Sueldo Total: </b> $acumulador €";

        ?>
        
    </body>
    
</html>       

