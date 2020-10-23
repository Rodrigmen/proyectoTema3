<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio12 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
         <style>
             body{
                 background-color: #A9C6FF;
             }
             h2{
                 text-align: center;
             }
             
             table{
                 margin: auto;    
             }
             .key{
                 text-align: center;
                 background: black;
                 color:white;
             }
             .valor{
                 background: white;
             }
             
             
         </style>
    </head>
    <body>
        <h1>FOREACH</h1>
            <table>  
                <tr>
                    <h2>$_SERVER</h2>              
                </tr>

                <?php
                    /**
                    * Mostrar el contenido de las variables superglobales (utilizando print_r() y foreach()).
                    * 
                    * @version 1.0.0
                    * @since 14-10-2020
                    * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
                    */

                    foreach ($_SERVER as $apartado => $valor) {
                       echo '<tr> <td class="key">'. $apartado . '</td><td class="valor">'.$valor.'</td> </tr>';
                    }



                ?> 
            </table>
        
        <h1>PRINT_R</h1>
            <?php
                    print_r($_SERVER);
            ?> 
    </body>
    
</html>       

