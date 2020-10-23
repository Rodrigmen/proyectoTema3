<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio18 - DWES</title>
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
        
            echo '<h1>Reservas en el Teatro - FUNCIONES</h1>';

            /*CONSTANTES(son el número máximo de filas y columnas)*/
            define("NFILAS", 20);
            define("NCOLUMNAS", 15);

            /*CREACIÓN E INALIZACIÓN del array || aTeatro[filas][columnas]=>espectador||*/
            for ($iFila = 1; $iFila <= NFILAS; $iFila++) {
                for ($iCol = 1; $iCol <= NCOLUMNAS; $iCol++) {
                    $aTeatro[$iFila][$iCol]= null; //En cada fila (20 en total) hay 15 columnas, el valor predeterminado del espectador es null
                }
            }
            
            //Insertamos espectadores en el teatro (su valor ya no es null)
            $aTeatro[1][1]='Espectador1';
            $aTeatro[5][2]='Espectador2';
            $aTeatro[10][3]='Espectador3';
            $aTeatro[15][4]='Espectador4';
            $aTeatro[20][5]='Espectador5';
            
            echo '<b>array_walk: </b><br>';
            function RecorrerFilas($aColumnas, $fila){
                array_walk($aColumnas, 'RecorrerColumnas', $fila);              
            }
                function RecorrerColumnas($ocupante, $columna, $fila){
                    if($ocupante!==null){
                         echo "Fila $fila, Columna $columna: $ocupante <br>";
                    }
                }
                    
            array_walk($aTeatro, 'RecorrerFilas');
            
            
            echo '<br><br><b>print_r: </b>';
            print_r($aTeatro);
            
            
            echo '<br><br><b>print_r + array_values: </b>';
            print_r(array_values($aTeatro));
            
            
            echo '<br><br><b>print_r + array_keys: </b>';
            print_r(array_keys($aTeatro));
            
            
            echo '<br><br><b>var_dump: </b>';
            echo var_dump($aTeatro);

        ?>
        
    </body>
    
</html>       

