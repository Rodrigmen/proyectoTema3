<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio04 - DWES</title>
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
             * Mostrar en tu página index la fecha y hora actual en Oporto formateada en portugués.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
            
            setlocale(LC_ALL, 'pt_PT.UTF-8', 'portuguese');//Establecemos la información del localismo: LC_ALL para establecer todas las siguientes y las establecemos al castellano
            date_default_timezone_set('Europe/Lisbon'); //Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
            $hoy = strftime("Hoje é %A, %d de %B do %G ás %T");//strftime se utiliza para obtener un string expresado en el lenguaje de la configuración local
            echo "$hoy <br><br>";
           
            /*Como datetime [objeto]*/
            echo "<b>DateTime</b> =>";
            
            $oFecha = new DateTime();//creación del objeto
            echo $oFecha->format('d-m-Y H:i:s');//Devuelve la fecha formateada según el formato dado
        ?>
        
    </body>
    
</html>       

