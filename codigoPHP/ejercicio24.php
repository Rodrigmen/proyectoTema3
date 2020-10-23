<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio24 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
         <link href="../webroot/css/styleForm.css" rel="stylesheet" type="text/css"/>
         
    </head>
    <body>
        <?php
            /**
             *  Construir un formulario para recoger un cuestionario realizado a una persona y mostrar en la misma página las preguntas y las respuestas
             * recogidas; en el caso de que alguna respuesta esté vacía o errónea volverá a salir el formulario con el mensaje correspondiente, pero las
             * respuestas que habíamos tecleado correctamente aparecerán en el formulario y no tendremos que volver a teclearlas.

             * 
             * @version 2.0.0
             * @since 21-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';
            setlocale(LC_ALL, 'es_ES.UTF-8');
            
            //Creamos una variable boleana para definir cuando esta bien o mal rellenado el formulario
            $entradaOK = true;
            
            //Creamos dos constantes: 'REQUIRED' indica si un campo es obligatorio (tiene que tener algun valor); 'OPTIONAL' indica que un campo no es obligatorio
            define('REQUIRED', 1);
            define('OPTIONAL', 0);
           
            //Array que contiene los posibles errores de los campos del formulario
            $aErrores=[
                'eNombre'=> null,
                'eEdad'=> null,
                'eCorreo'=> null,
                'eSexo'=> null,
                'eLista'=> null
                
            ];
            
            //Array que contiene los valores correctos de los campos del formulario
            $aFormulario=[
                'fNombre'=> null,
                'fEdad' => null,
                'fCorreo'=> null,
                'fSexo'=> null,
                'fLista'=> null,
                'fAsignaturas'=> null
                
            ];
            
            if(isset($_POST['enviar'])){ //si se pulsa 'enviar' (input name="enviar")
                
                //Validación de los campos (el resultado de la validación se mete en el array aErrores para comprobar posteriormente si da error)
                
                    //NOMBRE (input type="text") [OBLIGATORIO {texto alfabetico}] 
                    $aErrores['eNombre']= validacionFormularios::comprobarAlfabetico($_POST['nombre'], 100, 1, REQUIRED);
                        
                    //FECHA DE NACIMIENTO (input type="date") [OBLIGATORIO {formato: dia/mes/año}]
                    $aErrores['eEdad']= validacionFormularios::validarFecha($_POST['edad'], "01/01/2100", "01/01/1900",REQUIRED);
                        
                    //CORREO (input type="text") [OPCIONAL {texto alfanumérico}]
                    $aErrores['eCorreo']= validacionFormularios::validarEmail($_POST['correo'], OPTIONAL);
                        
                    //SEXO (input type="radio") [OBLIGATORIO {1 única elección}]
                    if(!isset($_POST['sexo'])){ //sino se introduce un valor, se introduce en el array de errores la siguiente cadena (y se muestra en el formulario)
                        $aErrores['eSexo'] = "Debe marcarse un valor";
                    }
                        
                    //LISTA DE HORAS ESTUDIADAS (select) [OBLIGATORIO {1 única elección}]
                    $aErrores['eLista']= validacionFormularios::validarElementoEnLista($_POST['lista'], ['ni una hora', '1 hora', '2 horas', '3 horas']);
                
                    //ASIGNATURAS ELEGIBLES (checkbox) [OPCIONAL {0 o varias elecciones}]
                        //Lo iniciamos a 0 previa inserción de valor al enviar el formulario, ya que su valor inicial es 'null' y daría error 
                        //por tener un elemento sin definir (undefined). También se mantiene el valor en 0 si no se elige ninguna asignatura
                        if(!isset($_POST['asignaturas'])){
                            $aFormulario['fAsignaturas'] = 0;
                        }else{
                           $aFormulario['fAsignaturas']= $_POST['asignaturas'];

                        }
                
                //recorremos el array de posibles errores (aErrores), si hay alguno, el campo se limpia y entradaOK es falsa (se vuelve a cargar el formulario)
                foreach ($aErrores as $campo => $validacion) {
                   if($validacion!=null){
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
                $aFormulario['fCorreo']= $_POST['correo'];
                $aFormulario['fSexo']= $_POST['sexo'];
                $aFormulario['fLista']= $_POST['lista'];
                
                    //Manejamos el formato con el que va a salir la fecha de nacimiento
                        $nacimiento = strftime("el %A %d de %B del %G",strtotime($aFormulario['fEdad']));
                    //Y sacamos la edad a traves de el objeto DateTime
                        $cumpleanos = new DateTime($aFormulario['fEdad']);
                        $hoy = new DateTime();
                        $annos = $hoy->diff($cumpleanos);
                        $annosS=$annos->y;
                        
                //Se muestra la salida de los datos insertados
                
                echo '<div class="respuesta">'
                . '<div class="rRequired">¡Hola <span class="destacar">'. $aFormulario['fNombre'].'</span>!</div>'
                . '<div class="rRequired">¡Naciste el <span class="destacar">'. $nacimiento.'</span>, tienes <span class="destacar">'. $annosS.'</span> años!</div>';
                
                if($aFormulario['fCorreo']!==""){
                    echo '<div class="rOptional">¡Tu correo electrónico es <span class="destacar">'. $aFormulario['fCorreo'].'</span>! </div>';
                }
                
                echo '<div class="rRequired">¡Eres un/a <span class="destacar">'. $aFormulario['fSexo'].'</span>!</div>'
                . '<div class="rRequired">¡Diariamente estudias <span class="destacar">'.$aFormulario['fLista'].'</span>!</div>';
               
                if($aFormulario['fAsignaturas']!==0){
                    echo '<div class="rOptional">Asignaturas que estudias diariamente: <ul>';
                        foreach ($aFormulario['fAsignaturas'] as $valor) {
                            echo '<li><span class="destacar">'.$valor.'</span></li>';
                        }
                    echo '</ul></div>';
                }
                echo '</div>';
     
                               
                    
       
            }else{ // si el formulario no esta correctamente rellenado (campos vacios o valores introducidos incorrectos) o no se ha rellenado nunca
                
                //formulario
        ?>
                <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Formulario Personal</legend>
                        
                        <!-----------------NOMBRE----------------->
                        <div class="required">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" placeholder="Abcd..." value="<?php 
                                //si no hay error y se ha insertado un valor en el campo con anterioridad
                                if($aErrores['eNombre']==null && isset($_POST['nombre'])){ 

                                    //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                    //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                    echo $_POST['nombre'];   
                                } 
                            ?>"/>
                                                   
                            <?php 
                                //si hay error en este campo
                                if ($aErrores['eNombre'] != NULL) {
                                    echo "<div class='errores'>".
                                        //se muestra dicho error
                                        $aErrores['eNombre']. 
                                    '</div>'; 
                                }
                            ?>
                        </div>
                        
                        <!-----------------FECHA DE NACIMIENTO----------------->
                        <div class="required">
                            <label for="edad">Fecha de Nacimiento:</label>
                            <input type="date" name="edad" value="<?php 
                                //si no hay error y se ha insertado un valor en el campo con anterioridad
                                if(is_null($aErrores['eEdad']) && isset($_POST['edad'])){ 

                                    //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                    //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                    echo $_POST['edad'];   
                                } 
                            ?>"/>
                                                    
                            <?php 
                                //si hay error en este campo
                                if ($aErrores['eEdad'] != NULL) {
                                    echo "<div class='errores'>".
                                        //se muestra dicho error
                                        $aErrores['eEdad']. 
                                    '</div>'; 
                                }
                            ?>
                        </div>
                            
                        <!-----------------CORREO ELECTRÓNICO----------------->
                        <div class="optional">
                            <label for="correo">Correo Electrónico: </label>
                            <input type="text" class="correo" placeholder="tunombre@hotmail.com" name="correo" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if(is_null($aErrores['eCorreo']) && isset($_POST['correo'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['correo'];   
                                    } 
                                ?>"/>
                                                        
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eCorreo'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eCorreo']. 
                                        '</div>'; 
                                    }
                                ?>
                              </div>
                        
                        <!-----------------SEXO----------------->
                        <div class="required">
                                <label>Sexo:</label>
                                
                                <!--Cada opción la organizamos en un div, el cual contiene el input type="radio" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                <div>
                                    <input type="radio" id="hombre" name="sexo" value="hombre" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['sexo']) && $_POST['sexo'] == "hombre"){ 
                                        //se marca la opción
                                        echo 'checked';
                                    } 
                                    ?>/>
                                    <label for="hombre">Hombre</label>
                                </div>

                                <!--Cada opción la organizamos en un div, el cual contiene el input type="radio" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                <div>
                                    <input type="radio" id="mujer" name="sexo" value="mujer" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['sexo']) && $_POST['sexo'] == "mujer"){ 
                                        //se marca la opción
                                        echo 'checked';
                                          
                                    } 
                                    ?>/>
                                    <label for="mujer">Mujer</label>
                                </div>
                            
                        
                            <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eSexo'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eSexo']. 
                                        '</div>'; 
                                    }
                                ?>
                        </div>
                        
                        <!-------------------HORAS DE ESTUDIO-------------->
                        <div class="required">
                            <label>Horas de estudio diario: </label>
                                <select name="lista">
                                    <!--En el select, las diferentes opciones se dividen por en grupos llamados "option" con su respectivo valor-->
                                    <option value="ni una hora" 
                                        <?php
                                            //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                            if(isset($_POST['lista']) && $_POST['lista'] == "ni una hora"){ 
                                                //se marca la opción
                                                echo 'selected';
                                            } 
                                        ?>>Ni una hora</option>
                                    
                                    <option value="1 hora" 
                                        <?php 
                                            //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                            if(isset($_POST['lista']) && $_POST['lista'] == "1 hora"){ 
                                                //se marca la opción
                                                echo 'selected';
                                            } 
                                        ?>>1 Hora</option>
                                    
                                    <option value="2 horas" 
                                        <?php 
                                            //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                            if(isset($_POST['lista']) && $_POST['lista'] == "2 horas"){ 
                                                //se marca la opción
                                                echo 'selected';
                                            } 
                                        ?>>2 Horas</option>
                                    
                                    <option value="3 horas" 
                                        <?php
                                            //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                            if(isset($_POST['lista']) && $_POST['lista'] == "3 horas"){ 
                                                //se marca la opción
                                                echo 'selected';
                                            } 
                                        ?>>3 Horas</option>
                                    
                                </select>
                        
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eLista'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eLista']. 
                                        '</div>'; 
                                    }
                                ?>
                        </div>
                        
                        <!-------------------ASIGNATURAS-------------->
                        <div class="optional">
                            <label>Asignaturas que estudias diariamente: </label>
                                <div>
                                    <!--Cada opción la organizamos en un div, el cual contiene el input type="checkbox" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                    <div>
                                        <input type="checkbox" id="php" name="asignaturas[dwes]" value="DWES" 
                                            <?php
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST['asignaturas']['dwes'])){
                                                    //se marca la opción
                                                    echo 'checked';
                                                } 
                                            ?>
                                        />
                                            <label for="php">DWES</label>
                                    </div>
                                    
                                    <!--Cada opción la organizamos en un div, el cual contiene el input type="checkbox" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                    <div>
                                        <input type="checkbox" id="js" name="asignaturas[dwec]" value="DWEC" 
                                            <?php 
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST['asignaturas']['dwec'])){
                                                    //se marca la opción
                                                    echo 'checked';
                                                } 
                                            ?>
                                        />
                                            <label for="js">DWEC</label>
                                    </div>
                                        
                                    <!--Cada opción la organizamos en un div, el cual contiene el input type="checkbox" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                    <div>
                                        <input type="checkbox" id="ubuntu" name="asignaturas[daw]" value="DAW" 
                                            <?php 
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST['asignaturas']['daw'])){
                                                    //se marca la opción
                                                    echo 'checked';

                                                } 
                                            ?>
                                        /> 
                                            <label for="ubuntu">DAW</label>
                                    </div>
                                    
                                </div>
                            
                        </div> 
                                        
                        <input type="submit" name="enviar" value="Enviar" />
                    </fieldset>
                </form>
        <?php
            }
        ?>
       
    </body>
    
</html>       

