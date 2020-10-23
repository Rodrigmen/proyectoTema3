<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio27 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
         <link href="../webroot/css/styleForm3.css" rel="stylesheet" type="text/css"/>
         
         
    </head>
    <body>
        <?php
            /**
             * Encuesta para 3 personas
             * 
             * @version 1.0.0
             * @since 22-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';
            setlocale(LC_ALL, 'es_ES.UTF-8');
            
            //Creamos una variable boleana para definir cuando esta bien o mal rellenado el formulario
            $entradaOK = true;
            
            //Creamos tres constantes: 
                //'REQUIRED' indica si un campo es obligatorio (tiene que tener algun valor); 'OPTIONAL' indica que un campo no es obligatorio
            define('REQUIRED', 1);
            define('OPTIONAL', 0);
                //'NPERSONAS' nos va a indicar el número de personas que quieren realizar el formulario
            define('NPERSONAS', 3);
           
            for ($i = 1; $i <= NPERSONAS; $i++) {
                //Array que contiene los posibles errores de los campos del formulario
                $aErrores[$i]=[
                    'eNombre'=> null,
                    'eEdad'=> null,
                    'eCorreo'=> null,
                    'eSexo'=> null,
                    'eLista'=> null
                ];
                
                //Array que contiene los valores correctos de los campos del formulario
                $aFormulario[$i]=[
                    'fNombre'=> null,
                    'fEdad' => null,
                    'fCorreo'=> null,
                    'fSexo'=> null,
                    'fLista'=> null,
                    'fAsignaturas'=> null
                ];
            }
            
            
            
            
            if(isset($_POST['enviar'])){ //si se pulsa 'enviar' (input name="enviar")
                
                //Validación de los campos (el resultado de la validación se mete en el array aErrores para comprobar posteriormente si da error)
                for ($v = 1; $v <= NPERSONAS; $v++) {
                    //NOMBRE (input type="text") [OBLIGATORIO {texto alfabetico}] 
                    $aErrores[$v]['eNombre']= validacionFormularios::comprobarAlfabetico($_POST[$v]['nombre'], 100, 1, REQUIRED);
                        
                    //FECHA DE NACIMIENTO (input type="date") [OBLIGATORIO {formato: dia/mes/año}]
                    $aErrores[$v]['eEdad']= validacionFormularios::validarFecha($_POST[$v]['edad'], "01/01/2100", "01/01/1900",REQUIRED);
                    
                    //CORREO (input type="text") [OPCIONAL {texto alfanumérico}]
                    $aErrores[$v]['eCorreo']= validacionFormularios::validarEmail($_POST[$v]['correo'], OPTIONAL);
                        
                    //SEXO (input type="radio") [OBLIGATORIO {1 única elección}]
                    if(!isset($_POST[$v]['sexo'])){ //sino se introduce un valor, se introduce en el array de errores la siguiente cadena (y se muestra en el formulario)
                        $aErrores[$v]['eSexo'] = "Debe marcarse un valor";
                    }
                        
                    //LISTA DE HORAS ESTUDIADAS (select) [OBLIGATORIO {1 única elección}]
                    $aErrores[$v]['eLista']= validacionFormularios::validarElementoEnLista($_POST[$v]['lista'], ['ni una hora', '1 hora', '2 horas', '3 horas']);
                
                    //ASIGNATURAS ELEGIBLES (checkbox) [OPCIONAL {0 o varias elecciones}]
                        //Lo iniciamos a 0 previa inserción de valor al enviar el formulario, ya que su valor inicial es 'null' y daría error 
                        //por tener un elemento sin definir (undefined). También se mantiene el valor en 0 si no se elige ninguna asignatura
                        if(!isset($_POST[$v]['asignaturas'])){
                            $aFormulario[$v]['fAsignaturas'] = 0;
                        }else{
                           $aFormulario[$v]['fAsignaturas']= $_POST[$v]['asignaturas'];

                        }
                    
                    //recorremos el array de posibles errores (aErrores), si hay alguno, el campo se limpia y entradaOK es falsa (se vuelve a cargar el formulario)
                    foreach ($aErrores[$v] as $campo => $validacion) {
                       if($validacion!=null){
                           $entradaOK=false;
                       }
                    }
                }   
                
            }else{ // sino se pulsa 'enviar'
                $entradaOK=false;
            }
            
            if($entradaOK){ //si el formulario esta bien rellenado
                $hoy = new DateTime();
                
                for ($e = 1; $e <= NPERSONAS; $e++) {
                   //Metemos en el array aFormulario los valores introducidos en el formulario ya que son correctos
                    $aFormulario[$e]['fNombre']= $_POST[$e]['nombre'];
                    $aFormulario[$e]['fEdad']= $_POST[$e]['edad'];
                    $aFormulario[$e]['fCorreo']= $_POST[$e]['correo'];
                    $aFormulario[$e]['fSexo']= $_POST[$e]['sexo'];
                    $aFormulario[$e]['fLista']= $_POST[$e]['lista'];
                    
                        //Manejamos el formato con el que va a salir la fecha de nacimiento
                            $nacimiento[$e] = strftime("el %A %d de %B del %G",strtotime($aFormulario[$e]['fEdad']));
                        //Y sacamos la edad a traves de el objeto DateTime
                            $cumpleanos[$e] = new DateTime($aFormulario[$e]['fEdad']);
                            $annos[$e] = $hoy->diff($cumpleanos);
                            $annosS[$e]=$annos->y;

                    //Se muestra la salida de los datos insertados

                    echo '<h1>Respuesta de la encuesta '. $e . '</h1><div class="respuesta">'
                    . '<div class="rRequired">¡Hola <span class="destacar">'. $aFormulario[$e]['fNombre'].'</span>!</div>'
                    . '<div class="rRequired">¡Naciste el <span class="destacar">'. $nacimiento[$e].'</span>, tienes <span class="destacar">'. $annosS[$e].'</span> años!</div>';
                    
                    if($aFormulario[$e]['fCorreo']!==""){
                    echo '<div class="rOptional">¡Tu correo electrónico es <span class="destacar">'. $aFormulario[$e]['fCorreo'].'</span>!</div>';
                    }

                    echo '<div class="rRequired">¡Eres un/a <span class="destacar">'. $aFormulario[$e]['fSexo'].'</span>!</div>'
                    . '<div class="rRequired">¡Diariamente estudias <span class="destacar">'.$aFormulario[$e]['fLista'].'</span>!</div>';

                    if($aFormulario[$e]['fAsignaturas']!==0){
                        echo '<div class="rOptional">Asignaturas que estudias diariamente:<ul>';
                            foreach ($aFormulario[$e]['fAsignaturas'] as $valor) {
                                echo '<li><span class="destacar">'.$valor.'</span></li>';
                            }
                        echo '</ul></div>';
                    }
                    echo '</div>';
                    }
                
                               
                    
       
            }else{ // si el formulario no esta correctamente rellenado (campos vacios o valores introducidos incorrectos) o no se ha rellenado nunca
                
                //formulario
        ?>
                <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <?php 
                            for ($formulario = 1; $formulario <= NPERSONAS; $formulario++) {
                        ?>
                        <fieldset>
                            <legend>Encuesta personal Nº<?php echo $formulario ?></legend>

                            <!-----------------NOMBRE----------------->
                            <div class="required">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="<?php echo $formulario?>[nombre]" placeholder="Abcd..." value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores[$formulario]['eNombre']==null && isset($_POST[$formulario]['nombre'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST[$formulario]['nombre'];   
                                    } 
                                ?>"/>

                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores[$formulario]['eNombre'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores[$formulario]['eNombre']. 
                                        '</div>'; 
                                    }
                                ?>
                            </div>

                            <!-----------------FECHA DE NACIMIENTO----------------->
                            <div class="required">
                                <label for="edad">Fecha de Nacimiento:</label>
                                <input type="date" name="<?php echo $formulario?>[edad]" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if(is_null($aErrores[$formulario]['eEdad']) && isset($_POST[$formulario]['edad'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST[$formulario]['edad'];   
                                    } 
                                ?>"/>

                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores[$formulario]['eEdad'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores[$formulario]['eEdad']. 
                                        '</div>'; 
                                    }
                                ?>
                            </div>
                            
                            <!-----------------CORREO ELECTRÓNICO----------------->
                            <div class="optional">
                                <label for="correo">Correo Electrónico: </label>
                                <input type="text" class="correo" placeholder="tunombre@hotmail.com" name="<?php echo $formulario?>[correo]" value="<?php 
                                        //si no hay error y se ha insertado un valor en el campo con anterioridad
                                        if(is_null($aErrores[$formulario]['eCorreo']) && isset($_POST[$formulario]['correo'])){ 

                                            //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                            //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                            echo $_POST[$formulario]['correo'];   
                                        } 
                                    ?>"/>

                                    <?php 
                                        //si hay error en este campo
                                        if ($aErrores[$formulario]['eCorreo'] != NULL) {
                                            echo "<div class='errores'>".
                                                //se muestra dicho error
                                                $aErrores[$formulario]['eCorreo']. 
                                            '</div>'; 
                                        }
                                    ?>
                                  </div>

                            <!-----------------SEXO----------------->
                            <div class="required">
                                    <label>Sexo:</label>

                                    <!--Cada opción la organizamos en un div, el cual contiene el input type="radio" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                    <div>
                                        <input type="radio" id="<?php echo $formulario?>hombre" name="<?php echo $formulario?>[sexo]" value="hombre" <?php
                                        //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                        if(isset($_POST[$formulario]['sexo']) && $_POST[$formulario]['sexo'] == "hombre"){ 
                                            //se marca la opción
                                            echo 'checked';
                                        } 
                                        ?>/>
                                        <label for="<?php echo $formulario?>hombre">Hombre</label>
                                    </div>

                                    <!--Cada opción la organizamos en un div, el cual contiene el input type="radio" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                    <div>
                                        <input type="radio" id="<?php echo $formulario?>mujer" name="<?php echo $formulario?>[sexo]" value="mujer" <?php
                                        //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                        if(isset($_POST[$formulario]['sexo']) && $_POST[$formulario]['sexo'] == "mujer"){ 
                                            //se marca la opción
                                            echo 'checked';

                                        } 
                                        ?>/>
                                        <label for="<?php echo $formulario?>mujer">Mujer</label>
                                    </div>


                                <?php 
                                        //si hay error en este campo
                                        if ($aErrores[$formulario]['eSexo'] != NULL) {
                                            echo "<div class='errores'>".
                                                //se muestra dicho error
                                                $aErrores[$formulario]['eSexo']. 
                                            '</div>'; 
                                        }
                                    ?>
                            </div>

                            <!-------------------HORAS DE ESTUDIO-------------->
                            <div class="required">
                                <label>Horas de estudio diario: </label>
                                    <select name="<?php echo $formulario?>[lista]">
                                        <!--En el select, las diferentes opciones se dividen por en grupos llamados "option" con su respectivo valor-->
                                        <option value="ni una hora" 
                                            <?php
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST[$formulario]['lista']) && $_POST[$formulario]['lista'] == "ni una hora"){ 
                                                    //se marca la opción
                                                    echo 'selected';
                                                } 
                                            ?>>Ni una hora</option>

                                        <option value="1 hora" 
                                            <?php 
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST[$formulario]['lista']) && $_POST[$formulario]['lista'] == "1 hora"){ 
                                                    //se marca la opción
                                                    echo 'selected';
                                                } 
                                            ?>>1 Hora</option>

                                        <option value="2 horas" 
                                            <?php 
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST[$formulario]['lista']) && $_POST[$formulario]['lista'] == "2 horas"){ 
                                                    //se marca la opción
                                                    echo 'selected';
                                                } 
                                            ?>>2 Horas</option>

                                        <option value="3 horas" 
                                            <?php
                                                //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                if(isset($_POST[$formulario]['lista']) && $_POST[$formulario]['lista'] == "3 horas"){ 
                                                    //se marca la opción
                                                    echo 'selected';
                                                } 
                                            ?>>3 Horas</option>

                                    </select>

                                    <?php 
                                        //si hay error en este campo
                                        if ($aErrores[$formulario]['eLista'] != NULL) {
                                            echo "<div class='errores'>".
                                                //se muestra dicho error
                                                $aErrores[$formulario]['eLista']. 
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
                                            <input type="checkbox" id="<?php echo $formulario?>php" name="<?php echo $formulario?>[asignaturas][dwes]" value="DWES" 
                                                <?php
                                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                    if(isset($_POST[$formulario]['asignaturas']['dwes'])){
                                                        //se marca la opción
                                                        echo 'checked';
                                                    } 
                                                ?>
                                            />
                                                <label for="<?php echo $formulario?>php">DWES</label>
                                        </div>

                                        <!--Cada opción la organizamos en un div, el cual contiene el input type="checkbox" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                        <div>
                                            <input type="checkbox" id="<?php echo $formulario?>js" name="<?php echo $formulario?>[asignaturas][dwec]" value="DWEC" 
                                                <?php 
                                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                    if(isset($_POST[$formulario]['asignaturas']['dwec'])){
                                                        //se marca la opción
                                                        echo 'checked';
                                                    } 
                                                ?>
                                            />
                                                <label for="<?php echo $formulario?>js">DWEC</label>
                                        </div>

                                        <!--Cada opción la organizamos en un div, el cual contiene el input type="checkbox" y su respectivo label [todas las opciones forman parte del mismo grupo gracias al name del input] -->
                                        <div>
                                            <input type="checkbox" id="<?php echo $formulario?>ubuntu" name="<?php echo $formulario?>[asignaturas][daw]" value="DAW" 
                                                <?php 
                                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                                    if(isset($_POST[$formulario]['asignaturas']['daw'])){
                                                        //se marca la opción
                                                        echo 'checked';

                                                    } 
                                                ?>
                                            /> 
                                                <label for="<?php echo $formulario?>ubuntu">DAW</label>
                                        </div>

                                    </div>

                            </div> 
                          
                        
                                        
                        
                        
                    </fieldset>
                     <?php 
                            }
                        ?>
                    <input type="submit" name="enviar" value="Enviar" />
                </form>
        <?php
            }
        ?>
       
    </body>
    
</html>       

