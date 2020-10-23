<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio03 - DWES</title>
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
             * Mostrar en tu página index la fecha y hora actual formateada en castellano.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            /*Con procedimientos*/
            setlocale(LC_ALL, 'es_ES.UTF-8'); //Establecemos la información del localismo: LC_ALL para establecer todas las siguientes y las establecemos al castellano
            date_default_timezone_set('Europe/Madrid'); //Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
            $hoy = strftime("Hoy es %A, día %d de %B del %G a las %T");//strftime se utiliza para obtener un string expresado en el lenguaje de la configuración local
            echo "$hoy <br><br>";
            
            /*Como datetime [objeto]*/
            $oFecha = new DateTime(); //creación del objeto (Representación de la fecha y la hora.)
            $oFecha->setTimezone(new DateTimeZone('Europe/Madrid')); //establecemos su zona horaria 
            $oFechaSalida = $oFecha->format('d-m-Y H:i:s'); //Devuelve la fecha formateada según el formato dado 
            
            echo "<b>DateTime</b> => $oFechaSalida <br>";
            
            
            
            //Diferentes salidas de la fecha y hora
            echo 'Solo fecha: '.$oFecha->format('l j F Y') .'<br>'.
                'Solo día: '.$oFecha->format('j') .'<br>'.
                'Solo mes: '.$oFecha->format('F') .'<br>'.
                'Solo año: '.$oFecha->format('Y') .'<br>'.
                'Hora completa: '.$oFecha->format('G:i:s') .'<br>'.
                'Solo hora: '.$oFecha->format('G') .'<br>'.
                'Solo minutos: '.$oFecha->format('i') .'<br>'.
                'Solo segundos: '.$oFecha->format('s') .'<br><br>';
            
            //DateTime con valores predeterminados
            $oAmerica = new DateTime('12-10-1492', new DateTimeZone('America/Caracas')); 
            echo '<b>Descubrimiento de América: </b>'.$oAmerica->format('d-m-Y H:i:s').'<br><br>';
            
            
            //Fecha y hora en Estados Unidos a través de DateTime
            echo '<b>ESTADOS UNIDOS - Detroit</b><br>';
            
            $oFecha2 = new DateTime();
            $oFecha->setTimezone(new DateTimeZone('America/Detroit'));
            echo $oFecha2->format('d-m-Y H:i:s') .'<br>';
            echo 'Solo fecha: '.$oFecha2->format('l j F Y') .'<br>'.
                'Solo día: '.$oFecha2->format('j') .'<br>'.
                'Solo mes: '.$oFecha2->format('F') .'<br>'.
                'Solo año: '.$oFecha2->format('Y') .'<br>'.
                'Hora completa: '.$oFecha2->format('G:i:s') .'<br>'.
                'Solo hora: '.$oFecha2->format('G') .'<br>'.
                'Solo minutos: '.$oFecha2->format('i') .'<br>'.
                'Solo segundos: '.$oFecha2->format('s') .'<br><br>';
            
            
        ?>
        
    </body>
    
</html>       

