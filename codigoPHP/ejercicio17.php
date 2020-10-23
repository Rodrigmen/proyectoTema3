<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio17 - DWES</title>
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
             * Inicializar un array (bidimensional con dos índices numéricos) donde almacenamos el nombre de las personas que tienen reservado 
             * el asiento en un teatro de 20 filas y 15 asientos por fila. (Inicializamos el array ocupando únicamente 5 asientos). Recorrer el array con 
             * distintas técnicas (foreach(), while(), for()) para mostrar los asientos ocupados en cada fila y las personas que lo ocupan.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
            echo '<h1>Reservas en el Teatro</h1>';

            /*CONSTANTES(son el número máximo de filas y columnas)*/
            define("NFILAS", 20);
            define("NCOLUMNAS", 15);

            /*CREACIÓN E INALIZACIÓN del array || aTeatro[filas][columnas]=>espectador||*/
            for ($iFila = 1; $iFila <= NFILAS; $iFila++) {
                for ($iCol = 1; $iCol <= NCOLUMNAS; $iCol++) {
                    $aTeatro[$iFila][$iCol]=null; //En cada fila (20 en total) hay 15 columnas, el valor predeterminado del espectador es null
                }
            }
            
            //Insertamos espectadores en el teatro (su valor ya no es null)
            $aTeatro[1][1]='Espectador1';
            $aTeatro[5][2]='Espectador2';
            $aTeatro[10][3]='Espectador3';
            $aTeatro[15][4]='Espectador4';
            $aTeatro[20][5]='Espectador5';     
            
            echo '<h2>Fila C, Columna Y: Espectador Z</h2>';
            
          
            echo '<h3>FOREACH()</h3>';
            
            foreach ($aTeatro as $fila => $aColumnas) { //recorremos cada fila y sacamos sus columnas (aColumnas)
                foreach ($aColumnas as $columna => $ocupante) { //recorremos las columna y sacamos sus espectadores (cada espectador de cada fila - columna)
                    if(!is_null($ocupante)){ //si tiene un valor distinto de null
                      echo "Fila $fila, Columna $columna: $ocupante <br>";  // se muestra
                    }
                   
                }
            }
            
            echo '<h3>WHILE()</h3>';
            $filW=1; //contador de filas
            while($filW<=NFILAS){ //mientras el contador de filas sea inferior o igual al numero de filas(la constante NFILAS)
                $colW=1; //contador de columnas
                while($colW<=NCOLUMNAS){ //mientras el contador de filas sea inferior o igual al numero de columnas(la constante NCOLUMNAS)
                    if(!is_null($aTeatro[$filW][$colW])){ //si tiene un valor distinto de null
                        echo "Fila $filW, Columna $colW: ". $aTeatro[$filW][$colW].'<br>'; // se muestra
                    }
                    $colW++; //cada vez que pasemos una columna se suma 1 al contador
                }
                $filW++; //cada vez que pasemos una fila se suma 1 al contador
            }
            
            
            echo '<h3>FOR()</h3>';
            
            for ($filF = 1; $filF <= NFILAS; $filF++) { //recorremos las filas
                for ($colF = 1; $colF <= NCOLUMNAS; $colF++) { //recorremos las columnas de cada fila
                    if(!is_null($aTeatro[$filF][$colF])){ //si tiene un valor distinto de null
                        echo "Fila $filF, Columna $colF: ". $aTeatro[$filF][$colF].'<br>'; // se muestra
                    }
                }
            }
        ?>
        
    </body>
    
</html>       

