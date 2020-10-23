<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio21 - DWES</title>
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
             * Construir un formulario para recoger un cuestionario realizado a una persona y enviarlo a una página 
             * Tratamiento.php para que muestre las preguntas y las respuestas recogidas.
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
        //Solo el formulario; en el action del form indicamos en que archivo se va a procesar la respuesta (la cual aparece tras rellenar el formulario)
        ?>       
        <form action="ejercicio21Tratamiento.php" method="post">
            <fieldset>
                <legend>Formulario Personal</legend>
                <p>
                    <label for="nombre">Su nombre: </label>
                    <input type="text" name="nombre" />
                </p>
                <p>
                    <label for="edad">Su edad:</label> 
                    <input type="text" name="edad" />
                </p>
                <p><input type="submit" /></p>
            </fieldset>
        </form>

    </body>
    
</html>       

