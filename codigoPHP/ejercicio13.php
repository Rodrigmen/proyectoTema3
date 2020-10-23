<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio13 - DWES</title>
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
             * Crear una función que cuente el número de visitas a la página actual desde una fecha concreta.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             * @tutorial Para que la función del contador se ejecute hay que poner en el servidor el siguiente comando:
             * sudo chmod -R 777 /var/www/html/proyectoDWES/proyectoTema3/tmp/
             * Ya que el usuario que utiliza la aplicación no tiene los permismos que tendría OperadorWeb de escribir en esa carpeta
             */
        function contadorVisitas(){
                $file = "../tmp/contador.txt"; //el archivo que contiene el nº de vistas
                
                $contador=0;
                
                $fLeer = fopen($file, "r"); //abrimos el archivo en modo de lectura
                if($fLeer){
                        $contador = fread($fLeer, filesize($file)); //leemos el archivo
                        $contador = $contador + 1; //sumamos +1 al contador
                        fclose($fLeer);
                    }
                    
                $fEscribir=fopen("../tmp/contador.txt", "w+");
                if($fEscribir){
                        fwrite($fEscribir, $contador);
                        fclose($fEscribir);
                    }
                return $contador;
            }
            
            echo 'Nº Visitas desde el 07 del 10 de 2020: '. contadorVisitas();
        ?>
        
    </body>
    
</html>       

