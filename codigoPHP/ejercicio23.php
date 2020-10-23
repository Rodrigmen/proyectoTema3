<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio23 - DWES</title>
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
             * Construir un formulario para recoger un cuestionario realizado a una persona y mostrar en la misma página las preguntas y las respuestas
             * recogidas; en el caso de que alguna respuesta esté vacía o errónea volverá a salir el formulario con el mensaje correspondiente.
             * 
             * @version 1.5.0
             * @since 15-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';
            
            //Creamos una variable boleana para definir cuando esta bien o mal rellenado el formulario
            $entradaOK = true;
            
            //Creamos dos constantes: 'required' indica si un campo es obligatorio (tiene que tener algun valor); secundary indica que un campo no es obligatorio
            define('REQUIRED', 1);
            define('OPTIONAL', 0);
           
            //Array que contiene los posibles errores de los campos del formulario
            $aErrores=[
                'eNombre'=> null,
                'eEdad'=> null
            ];
            
            //Array que contiene los valores correctos de los campos del formulario
            $aFormulario=[
                'fNombre'=> null,
                'fEdad' => null
            ];
            
            if(isset($_POST['enviar'])){ //si se pulsa 'enviar' (input name="enviar")
                
                //Validación de los campos (el resultado de la validación se mete en el array aErrores para comprobar posteriormente si da error)
                $aErrores['eNombre']= validacionFormularios::comprobarAlfabetico($_POST['nombre'], 100, 1, REQUIRED);
                $aErrores['eEdad']= validacionFormularios::comprobarEntero($_POST['edad'], PHP_INT_MAX, -PHP_INT_MAX, REQUIRED);
                
                //recorremos el array de posibles errores (aErrores), si hay alguno, el campo se limpia y entradaOK es falsa (se vuelve a cargar el formulario)
                foreach ($aErrores as $campo => $error) {
                   if($error!=null){
                       $_REQUEST[$campo]="";
                       $entradaOK=false;
                   }
                }
            }else{ // sino se pulsa 'enviar'
                $entradaOK=false;
            }
            
            if($entradaOK){ //si el formulario esta bien rellenado
                
                //Metemos en el array aFormulario los valores introducidos en el formulario ya que son correctos
                $aFormulario['fNombre']= $_POST['nombre'];
                $aFormulario['fEdad']= $_POST['edad'];
                
                //Se muestra la salida
                
                echo '<p>Hola '. $aFormulario['fNombre'].'.</p>'.
                    '<p>Usted tiene '. $aFormulario['fEdad'].' años.</p>';
       
            }else{ // si el formulario no esta correctamente rellenado (campos vacios o valores introducidos incorrectos) o no se ha rellenado nunca
                
                //formulario
        ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Formulario Personal</legend>
                        <p>
                            <label for="nombre">Su nombre: </label>
                            <input type="text" name="nombre" />
                        </p>
                        <?php 
                        //si hay error en este campo
                            if ($aErrores['eNombre'] != NULL) {
                                echo '<div>'.
                                    //se muestra dicho error
                                    $aErrores['eNombre']. 
                                '</div>'; 
                            }
                        ?>
                        <p>
                            <label for="edad">Su edad:</label> 
                            <input type="text" name="edad" />
                        </p>
                        <?php 
                                //si hay error en este campo
                            if ($aErrores['eEdad'] != NULL) {
                                echo '<div>'.
                                    //se muestra dicho error
                                    $aErrores['eEdad']. 
                                '</div>'; 
                            }
                        ?> 
                        <p><input type="submit" name="enviar" value="Enviar" />
                    </fieldset>
                </form>
        <?php
            }
        ?>
        
    </body>
    
</html>       

