<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio28 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
         <style>
            .error{
                color: red;
                font-weight: bold;
            }
            
            legend{
                color: black;
                font-weight: bold;
            }
            input{
                padding: 5px;
                border-radius: 10px;
            }
            .obligatorio input{
                background-color: #ccc;
            }
        </style>
    </head>
    <body>
        <h2>Rodrigo Robles</h2>
        <?php
        /*
         * Autor: Nerea Nuevo Pascual
         * @since: 22/10/2020
         */

        //Declaramos la variables
        require_once '../core/201020libreriaValidacion.php'; //Importamos la librería 
        $entradaOK = true;
        setlocale(LC_ALL, 'es_ES.UTF-8');
        
        $arrayErrores = [ //Recoge los errores del formulario
            'eNombreapellidos' => null,
            'eFecha' => null,
            'eRadiohoy' => null,
            'eEnterocurso' => null, 
            'eListavacaciones' => null,
            'eTextoanimo' => null
        ]; 
        
        $arrayFormulario = [ //Recoge los datos del formulario
            'fNombreapellidos' => null,
            'fFecha' => null,
            'fRadiohoy' => null,
            'fEnterocurso' => null, 
            'fListavacaciones' => null,
            'fTextoanimo' => null
            
        ];  


        if (isset($_POST['enviar'])) { //Código que se ejecuta cuando se envía el formulario
            
            $arrayErrores['eNombreapellidos'] = validacionFormularios::comprobarAlfabetico($_POST['nombreapellidos'], 50, 1, 1);  //Máximo, mínimo y opcionalidad
            $arrayErrores['eFecha'] = validacionFormularios::validarFecha($_POST['fecha'], "01/01/2200", "01/01/1900", 1); //Opcionalidad
            if(!isset($_POST['rhoy'])){
                $arrayErrores['eRadiohoy'] = "Debe marcarse un valor";
                
            }
            $arrayErrores['eEnterocurso'] = validacionFormularios::comprobarEntero($_POST['ecurso'], 10, 1, 1); //Máximo, mínimo y opcionalidad
            $arrayErrores['eListavacaciones'] = validacionFormularios::validarElementoEnLista($_POST['lvacaciones'], ['ni idea', 'con la familia', 'de fiesta', 'trabajando', 'estudiando DWES']); //Opciones de la lista
            $arrayErrores['eTextoanimo'] = validacionFormularios::comprobarAlfaNumerico($_POST['tanimo'], 500, 1, 1); //Máximo, mínimo y opcionalidad
            
            foreach ($arrayErrores as $campo => $error) { //Recorre el array en busca de mensajes de error
                if ($error != null) { //Si lo encuentra vacia el campo y cambia la condiccion
                    $entradaOK = false; //Cambia la condiccion de la variable
                }
            }
        } else {
            $entradaOK = false;
        }


        if ($entradaOK) { // Si el formulario se ha rellenado correctamente
         
            // Cargamos en el $arrayFormulario el valos de aquellos campos que se han rellenado correctamente
  
            $arrayFormulario['fNombreapellidos'] = $_POST['nombreapellidos'];
            $arrayFormulario['fFecha'] = $_POST['fecha'];
            $arrayFormulario['fRadiohoy'] = $_POST['rhoy'];
            $arrayFormulario['fEnterocurso'] = $_POST['ecurso'];
            $arrayFormulario['fListavacaciones'] = $_POST['lvacaciones'];
            $arrayFormulario['fTextoanimo'] = $_POST['tanimo'];
            
            

            $hoy = strftime("%A %d de %B");
            $hora = strftime("%T");
                        $cumpleanos = new DateTime($arrayFormulario['fFecha']);
                        $hoy2 = new DateTime();
                        $annos = $hoy2->diff($cumpleanos);
                        $annosS=$annos->y;
            // Mostramos los valores
            echo "Hoy $hoy a las $hora <br>";
            echo "D. " .$arrayFormulario['fNombreapellidos'] . " nacido hace $annosS años <br>";
            echo "se siente " . $arrayFormulario['fRadiohoy'] . "<br>";
            echo "Valora su curso actual con un " . $arrayFormulario['fEnterocurso'] . " sobre 10.<br>";
            echo "Estas navidades las dedicara a " . $arrayFormulario['fListavacaciones'] . "<br>";
            echo "Y además opina que: " . $arrayFormulario['fTextoanimo'] . "<br>";
            
            
            
            
            
        } else { //Código que se ejecuta antes de rellenar el formulario
            ?>
            <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
                <fieldset>
                    <legend>Encuesta 28</legend>
                    <div class="obligatorio">
                        <label>Nombre y apellidos: </label>
                        <input type = "text" name = "nombreapellidos"
                               value="<?php 
                               if($arrayErrores['eNombreapellidos'] == NULL && isset($_POST['nombreapellidos'])){
                                   echo $_POST['nombreapellidos'];
                                   
                               } ?>"><br>
                    </div>
                    <div class="error">
                    <?php
                    if ($arrayErrores['eNombreapellidos'] != NULL) {
                        echo $arrayErrores['eNombreapellidos']; //Mensaje de error que tiene el $arrayErrores
                    }
                    ?>
                    </div>
                    <br>
                    
                    <br> <!---------------------------- FECHA -------------------------------------------->
                    
                    <div class="obligatorio">
                        <label>Fecha de nacimiento: </label>
                        <input type = "date" name = "fecha" value="<?php 
                               if($arrayErrores['eFecha'] == NULL && isset($_POST['fecha'])){
                                   echo $_POST['fecha'];
                                   
                               } ?>"><br>
                    </div>
                    <div class="error">
                    <?php
                    if ($arrayErrores['eFecha'] != NULL) {
                        echo $arrayErrores['eFecha']; //Mensaje de error que tiene el $arrayErrores
                    }
                    ?>
                    </div>
                    <br>
                    
                    <br> <!---------------------------- SELECTOR RADIO -------------------------------------------->
                    
                    <div>
                        <label>¿Cómo te sientes hoy? </label><br><br>
                        <div>
                                    <input type="radio" id="muymal" name="rhoy" value="muy mal" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['rhoy']) && $_POST['rhoy'] == "muy mal"){ 
                                        //se marca la opción
                                        echo 'checked';
                                    } 
                                    ?>/>
                                    <label for="muymal">Muy Mal</label>
                                </div>
                        <div>
                                    <input type="radio" id="mal" name="rhoy" value="mal" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['rhoy']) && $_POST['rhoy'] == "mal"){ 
                                        //se marca la opción
                                        echo 'checked';
                                    } 
                                    ?>/>
                                    <label for="mal">Mal</label>
                                </div>
                        <div>
                                    <input type="radio" id="regular" name="rhoy" value="regular" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['rhoy']) && $_POST['rhoy'] == "regular"){ 
                                        //se marca la opción
                                        echo 'checked';
                                    } 
                                    ?>/>
                                    <label for="regular">Regular</label>
                                </div>
                        <div>
                                    <input type="radio" id="bien" name="rhoy" value="bien" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['rhoy']) && $_POST['rhoy'] == "bien"){ 
                                        //se marca la opción
                                        echo 'checked';
                                    } 
                                    ?>/>
                                    <label for="bien">Bien</label>
                                </div>
                        <div>
                                    <input type="radio" id="muybien" name="rhoy" value="muy bien" <?php
                                    //si se ha insertado un valor en el campo con anterioridad y es en concreto este valor
                                    if(isset($_POST['rhoy']) && $_POST['rhoy'] == "muy bien"){ 
                                        //se marca la opción
                                        echo 'checked';
                                    } 
                                    ?>/>
                                    <label for="muybien">Muy Bien</label>
                                </div>

                                

                                
                    </div>
                    <div class="error">
                    <?php
                    if ($arrayErrores['eRadiohoy'] != NULL) {
                        echo $arrayErrores['eRadiohoy']; //Mensaje de error que tiene el $arrayErrores
                    }
                    ?>
                    </div>
                    
                    
                    <br> <!---------------------------- ENTERO -------------------------------------------->
                    
                    <div class="obligatorio">
                        <label>¿Cómo va el curso? [1-10]: </label>
                        <input type = "number" name = "ecurso" value="<?php 
                            if($arrayErrores['eEnterocurso'] == NULL && isset($_POST['ecurso'])){
                                echo $_POST['ecurso'];
                                
                            } ?>"><br>
                    </div>
                    <div class="error">
                    <?php
                    if ($arrayErrores['eEnterocurso'] != NULL) {
                        echo $arrayErrores['eEnterocurso']; //Mensaje de error que tiene el $arrayErrores
                    }
                    ?>
                    </div>
                    <br>
                    
                    <br> <!---------------------------- LISTA -------------------------------------------->
                    <div>
                        <label>¿Cómo se presentan las vacaciones de navidad?</label>
                                <select name="lvacaciones">
                                    <option value="ni idea" 
                                        <?php
                                            if(isset($_POST['lvacaciones']) && $_POST['lvacaciones'] == "ni idea"){ 
                                                echo 'selected';
                                            } 
                                        ?>>Ni idea</option>
                                    <option value="con la familia" 
                                        <?php
                                            if(isset($_POST['lvacaciones']) && $_POST['lvacaciones'] == "con la familia"){ 
                                                echo 'selected';
                                            } 
                                        ?>>Con la familia</option>
                                    <option value="de fiesta" 
                                        <?php
                                            if(isset($_POST['lvacaciones']) && $_POST['lvacaciones'] == "de fiesta"){ 
                                                echo 'selected';
                                            } 
                                        ?>>De fiesta</option>
                                    <option value="trabajando" 
                                        <?php
                                            if(isset($_POST['lvacaciones']) && $_POST['lvacaciones'] == "trabajando"){ 
                                                echo 'selected';
                                            } 
                                        ?>>Trabajando</option>
                                    <option value="estudiando DWES" 
                                        <?php
                                            if(isset($_POST['lvacaciones']) && $_POST['lvacaciones'] == "estudiando DWES"){ 
                                                echo 'selected';
                                            } 
                                        ?>>Estudiando DWES</option>
                                </select>
                    </div>
                    <div class="error">
                    <?php
                    if ($arrayErrores['eListavacaciones'] != NULL) {
                        echo $arrayErrores['eListavacaciones']; //Mensaje de error que tiene el $arrayErrores
                    }
                    ?>
                    </div>
                
                    
                    
                    <br> <!---------------------------- AREA DE TEXTO -------------------------------------------->

                    <div>
                        <label>Describe brevemente tu estado de ánimo:</label>
                        <textarea name="tanimo" placeholder="Maximo 500 caracteres" value="<?php 
                        if($arrayErrores['eTextoanimo'] == NULL && isset($_POST['tanimo'])){
                            echo $_POST['tanimo'];
                            
                        } ?>"></textarea>
                    </div>
                    <div class="error">
                    <?php
                    if ($arrayErrores['eTextoanimo'] != NULL) {
                        echo $arrayErrores['eTextoanimo']; //Mensaje de error que tiene el $arrayErrores
                    }
                    ?>
                    </div>
                    
                    
                                     
                    
                    
                    <div>
                        <br><input type = "submit" name = "enviar" value = "Enviar">
                    </div>
                </fieldset>
            </form>
        <?php } ?>
    </body>
    
</html>       

