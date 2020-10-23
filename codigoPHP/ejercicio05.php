<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio05 - DWES</title>
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
             * Inicializar y mostrar una variable que tiene una marca de tiempo (timestamp)
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
            
            /*MEDIANTE PROCEDIMIENTOS*/
            date_default_timezone_set("Europe/Madrid");//Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
            $zona = date_default_timezone_get();//Obtiene la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script

            echo "<br>Zona horaria: <b>$zona</b><br><br>";

            $fecha = date_create();//Devuelve un nuevo objeto DateTime
            date_timestamp_set($fecha, 5000000000); //Establece la fecha y la hora basándose en una marca temporal de Unix
            
            echo '<b>Fecha actual en Timestamp[Procedimientos]</b>: '. date_format($fecha, 'T d-M-Y H:i:s').'<br><br>';  //Devuelve la fecha formateada según el formato dado
            
            
            /*ORIENTADO A OBJETOS*/
            
            //España
            $oFecha = new DateTime();
            $oFecha->setTimezone(new DateTimeZone("Europe/Madrid"));
            $oFechaT=$oFecha->getTimestamp(); //Devuelve la marca temporal Unix
            $oFechaF=$oFecha->format('d-m-Y H:i:s');
            echo "<b>Fecha actual en Timestamp[DateTime] - ESPAÑA(Madrid)</b>:<br> Marca Unix: $oFechaT || FORMATO: $oFechaF <br><br>";

            //Portugal
            $oFechaP = new DateTime();
            $oFechaP->setTimezone(new DateTimeZone("Europe/Lisbon"));
            $oFechaPT=$oFechaP->getTimestamp(); //Devuelve la marca temporal Unix
            $oFechaPF=$oFechaP->format('d-m-Y H:i:s');
            echo "<b>Fecha actual en Timestamp[DateTime] - PORTUGAL(Lisboa)</b>:<br> Marca Unix: $oFechaPT || FORMATO: $oFechaPF <br><br>";
            
            //Insertada
            $oFecha2 = new DateTime();            
            $oFecha2->setTimestamp(0);
            $oFecha2T=$oFecha2->getTimestamp(); //Devuelve la marca temporal Unix
            $oFecha2F=$oFecha2->format('d-m-Y H:i:s');
            echo "<b>Fecha actual en Timestamp[DateTime-insertada]</b>:<br> Marca Unix: $oFecha2T || FORMATO: $oFecha2F <br><br>";
            
            
             
        ?>
        
    </body>
    
</html>       

