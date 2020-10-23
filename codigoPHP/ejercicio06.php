<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio06 - DWES</title>
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
             * Operar con fechas: calcular la fecha y el día de la semana de dentro de 60 días.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */

            $fecha = date('j-m-Y'); //Formato de la fecha/hora local 
            echo "Fecha actual: $fecha<br>";
            
            $nFecha = strtotime('60 day', strtotime($fecha)); //Analiza cualquier descripción textual de fecha y hora en inglés en una marca de tiempo de Unix [suma la marca Unix de '60 days' a la marca unix que deja strtotime($fecha)]
            $nFechaSalida = date('j-m-Y', $nFecha);
            echo "Fecha dentro de 60 días: $nFechaSalida<br>";
            
            /*DATETIME [ORIENTADO A OBJETOS]*/  
            
            //+60
            $oHoy = new DateTime();
            $oHoy->add(date_interval_create_from_date_string('60 days')); //Configura un DateInterval a partir de las partes relativas de la cadena
            echo 'Fecha +60 días con DateTime: '.$oHoy->format('d-m-Y') .'<br><br>';
            //-30
            $oHoy2 = new DateTime();
            $oHoy2->add(date_interval_create_from_date_string('-30 days'));
            echo 'Fecha -30 días con DateTime: '.$oHoy2->format('d-m-Y');
        ?>
        
    </body>
    
</html>       

