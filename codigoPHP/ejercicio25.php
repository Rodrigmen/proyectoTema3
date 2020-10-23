<!DOCTYPE html>
<html>
    <head>
       <title>ejercicio25 - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
         <style>
             body{
                 background-color: #A9C6FF;
             }
             
             .errores{
                 color:red;
             }
         </style>
    </head>
    <body>
        <?php
            /**
             * Trabajar en PlantillaFormulario.php, mi plantilla para hacer formularios como churros.
             * 
             * @version 1.0.0
             * @since 20-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
        
            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';
            require_once '../core/misFunciones.php';
            
            //Creamos una variable boleana para definir cuando esta bien o mal rellenado el formulario
            $entradaOK = true;
            
            //Creamos dos constantes: 'required' indica si un campo es obligatorio (tiene que tener algun valor); secundary indica que un campo no es obligatorio
            define('REQUIRED', 1);
            define('OPTIONAL', 0);
           
            //Array que contiene los posibles errores de los campos del formulario
            $aErrores=[
                'eAlfabetico'=> null,
                'eAlfanumerico'=> null,
                'ePassword'=> null,
                'eDni'=> null,
                'eCorreo'=> null,
                'eUrl'=> null,
                'eEntero'=> null,
                'eDecimal'=> null,
                'eBoolean2'=> null,
                'eCheck'=> null,
                'eLista'=> null,
                'eArchivo'=> null,
                'eColor'=> null,
                'eTirador'=> null
                
            ];
            
            //Array que contiene los valores correctos de los campos del formulario
            $aFormulario=[
                'fAlfabetico'=> null,
                'fAlfanumerico'=> null,
                'fPassword'=> null,
                'fDni'=> null,
                'fCorreo'=> null,
                'fUrl'=> null,
                'fEntero'=> null,
                'fDecimal'=> null,
                'fBoolean'=> null,
                'fBoolean2'=> null,
                'fCheck'=> null,
                'fCheck2'=> null,
                'fLista'=> null,
                'fArchivo'=> null,
                'fColor' => null,
                'fTirador' => null

            ];
            
            if(isset($_POST['enviar'])){ //si se pulsa 'enviar' (input name="enviar")
                
                //Validación de los campos (el resultado de la validación se mete en el array aErrores para comprobar posteriormente si da error)
                $aErrores['eAlfabetico']= validacionFormularios::comprobarAlfabetico($_POST['alfabetico'], 100, 1, REQUIRED);
                $aErrores['eAlfanumerico']= validacionFormularios::comprobarAlfaNumerico($_POST['alfanumerico'], 100, 1, REQUIRED);
                $aErrores['ePassword']= validacionFormularios::comprobarAlfaNumerico($_POST['password'], 15, 4, REQUIRED);
                $aErrores['eDni']= validacionFormularios::validarDni($_POST['dni'], REQUIRED);
                $aErrores['eCorreo']= validacionFormularios::validarEmail($_POST['correo'], REQUIRED);
                $aErrores['eUrl']= validacionFormularios::validarURL($_POST['url'], REQUIRED);
                $aErrores['eEntero']= validacionFormularios::comprobarEntero($_POST['entero'], PHP_INT_MAX, -PHP_INT_MAX, REQUIRED);
                $aErrores['eDecimal']= validacionFormularios::comprobarFloat($_POST['decimal'], PHP_FLOAT_MAX, PHP_FLOAT_MIN, REQUIRED);
                $aErrores['eColor']= comprobarColorHexadecimal($_POST['color'], OPTIONAL);
                //Radios: no pueden tener errores: en el obligatorio establezco un valor predeterminado asi que siempre tiene valor; y el opcional valido que se elige, sino pues el valor es 0
                //Este es el opcional (tambien se puede aplicar para el checkbox [valor predeterminado  ya que null da error)
                if(!isset($_POST['valorb2'])){
                    $aFormulario['fBoolean2'] = 0;
                }else{
                    $aFormulario['fBoolean2']= $_POST['valorb2'];
                }
                
                //Checkbox obligatorio
                if(!isset($_POST['check'])){
                    $aErrores['eCheck'] = "Debe marcarse al menos un valor";
                }else{
                   $aFormulario['fCheck']= $_POST['check'];
                    
                }
                
                //Checkbox opcional
                if(!isset($_POST['check2'])){
                    $aFormulario['fCheck2'] = 0;
                }else{
                   $aFormulario['fCheck2']= $_POST['check2'];
                    
                }
                
                $aErrores['eLista']= validacionFormularios::validarElementoEnLista($_POST['lista'], ['elemento1', 'elemento2', 'elemento3']);
                $aErrores['eArchivo']= validacionFormularios::comprobarNoVacio($_POST['archivo']);
                $aErrores['eTirador']= validacionFormularios::comprobarEntero($_POST['tirador'], 10, 0, REQUIRED);

                
                

                
                //recorremos el array de posibles errores (aErrores), si hay alguno, el campo se limpia y entradaOK es falsa (se vuelve a cargar el formulario)
                foreach ($aErrores as $campo => $error) {
                   if($error!=null){
                       $entradaOK=false;
                   }
                }
            }else{ // sino se pulsa 'enviar'
                $entradaOK=false;
            }
            
            if($entradaOK){ //si el formulario esta bien rellenado
                
                //Metemos en el array aFormulario los valores introducidos en el formulario ya que son correctos
                $aFormulario['fAlfabetico']= $_POST['alfabetico'];
                $aFormulario['fAlfanumerico']= $_POST['alfanumerico'];
                $aFormulario['fPassword']= $_POST['password'];
                $aFormulario['fDni']= $_POST['dni'];
                $aFormulario['fCorreo']= $_POST['correo'];
                $aFormulario['fUrl']= $_POST['url'];
                $aFormulario['fEntero']= $_POST['entero'];
                $aFormulario['fDecimal']= $_POST['decimal'];
                $aFormulario['fBoolean']= $_POST['valorb'];
                $aFormulario['fLista']= $_POST['lista'];
                $aFormulario['fArchivo']= $_POST['archivo'];
                $aFormulario['fColor']= $_POST['color'];
                $aFormulario['fTirador']= $_POST['tirador'];
                
                
                //Se muestra la salida
                echo '<p>Alfabético: '. $aFormulario['fAlfabetico'].'.</p>';
                echo '<p>Alfanumérico: '. $aFormulario['fAlfanumerico'].'.</p>'; 
                echo '<p>Contraseña: '. $aFormulario['fPassword'].'.</p>';
                echo '<p>DNI: '. $aFormulario['fDni'].'.</p>';
                echo '<p>Correo Electrónico: '. $aFormulario['fCorreo'].'.</p>';
                echo '<p>URL: '. $aFormulario['fUrl'].'.</p>';
                echo '<p>Número Entero: '. $aFormulario['fEntero'].'.</p>';
                echo '<p>Número Decimal: '. $aFormulario['fDecimal'].'.</p>';

                echo '<p>Valor Booleano: '. $aFormulario['fBoolean'].'.</p>';

                if($aFormulario['fBoolean2']!==0){
                    echo '<p>Valor Booleano Opcional: '. $aFormulario['fBoolean2'].'.</p>';
                }
                
                echo "<p>Elementos elegido en checkbox: </p><ul>";
                    foreach ($aFormulario['fCheck'] as $valor) {
                        echo "<li>$valor</li>";
                    }
                echo "</ul><br>";
                
                if($aFormulario['fCheck2']!==0){
                    echo "<p>Elementos elegido en checkbox opcional: </p><ul>";
                        foreach ($aFormulario['fCheck2'] as $valor) {
                            echo "<li>$valor</li>";
                        }
                    echo "</ul>";
                }
                
                echo '<p>Elemento de lista elegido: '.$aFormulario['fLista'].'</p>';
                echo '<p>Archivo elegido: '.$aFormulario['fArchivo'].'</p>';
                echo '<p>Color elegido: <input type="color" value="'. $aFormulario['fColor'].'" disabled/></p>';
                echo '<p>Valor del tirador: '. $aFormulario['fTirador'].'</p>';
                
                
    
                
                
                
            }else{ // si el formulario no esta correctamente rellenado (campos vacios o valores introducidos incorrectos) o no se ha rellenado nunca
                
                //formulario
        ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Plantilla Formulario</legend>
                        <!-- ALFABÉTICO -->
                        <p>
                            <label for="nombre">Alfabético: </label>
                            <input type="text" name="alfabetico" value="<?php 
                                //si no hay error y se ha insertado un valor en el campo con anterioridad
                                if($aErrores['eAlfabetico']== null && isset($_POST['alfabetico'])){ 

                                    //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                    //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                    echo $_POST['alfabetico'];   
                                } 
                            ?>"/>
                        </p>                            
                            <?php 
                                //si hay error en este campo
                                if ($aErrores['eAlfabetico'] != NULL) {
                                    echo "<div class='errores'>".
                                        //se muestra dicho error
                                        $aErrores['eAlfabetico']. 
                                    '</div>'; 
                                }
                            ?>
                        <!-- ALFANUMÉRICO -->
                            <p>
                                <label for="alfanumerico">Alfanumérico: </label>
                                <input type="text" name="alfanumerico" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['eAlfanumerico']== null && isset($_POST['alfanumerico'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['alfanumerico'];   
                                    } 
                                ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eAlfanumerico'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eAlfanumerico']. 
                                        '</div>'; 
                                    }
                                ?>
                        <!-- PASSWORD -->    
                            <p>
                                <label for="password">Contraseña: </label>
                                <input type="password" name="password" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['ePassword']== null && isset($_POST['password'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['password'];   
                                    } 
                                    ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['ePassword'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['ePassword']. 
                                        '</div>'; 
                                    }
                                ?>
                        <!-- DNI -->    
                            <p>
                                <label for="dni">DNI: </label>
                                <input type="text" name="dni" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['eDni']== null && isset($_POST['dni'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['dni'];   
                                    } 
                                    ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eDni'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eDni']. 
                                        '</div>'; 
                                    }
                                ?>
                            
                            <!-- EMAIL -->
                            <p>
                                <label for="correo">Correo Electrónico: </label>
                                <input type="text" name="correo" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['eCorreo']== null && isset($_POST['correo'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['correo'];   
                                    } 
                                ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eCorreo'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eCorreo']. 
                                        '</div>'; 
                                    }
                                ?>
                            
                            <!-- URL -->
                            <p>
                                <label for="url">URL: </label>
                                <input type="text" name="url" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['eUrl']== null && isset($_POST['url'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['url'];   
                                    } 
                                ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eUrl'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eUrl']. 
                                        '</div>'; 
                                    }
                                ?>
                            
                            <!-- NÚMERO ENTERO -->
                            <p>
                                <label for="entero">Número Entero: </label>
                                <input type="text" name="entero" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['eEntero']== null && isset($_POST['entero'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['entero'];   
                                    } 
                                ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eEntero'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eEntero']. 
                                        '</div>'; 
                                    }
                                ?>
                            
                            <!-- NÚMERO DECIMAL -->
                            <p>
                                <label for="decimal">Número Decimal: </label>
                                <input type="text" name="decimal" value="<?php 
                                    //si no hay error y se ha insertado un valor en el campo con anterioridad
                                    if($aErrores['eDecimal']== null && isset($_POST['decimal'])){ 

                                        //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                        //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                        echo $_POST['decimal'];   
                                    } 
                                ?>"/>
                            </p>                            
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eDecimal'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eDecimal']. 
                                        '</div>'; 
                                    }
                                ?>
                            
                            <!-- RADIO OBL -->
                            <p>Selección booleana (OBLIGATORIO):</p>
                                <div>
                                    <input type="radio" id="valorsi" name="valorb" value="Si" <?php 
                                    if(isset($_POST['valorb']) && $_POST['valorb'] == "Si"){ 

                                        echo 'checked';
                                          
                                    } 
                                    ?> checked/>
                                    <label for="valorsi">Sí</label>
                                </div>

                                <div>
                                    <input type="radio" id="valorno" name="valorb" value="No" <?php 
                                    if(isset($_POST['valorb']) && $_POST['valorb'] == "No"){ 

                                        echo 'checked';
                                          
                                    } 
                                ?>/>
                                    <label for="valorno">No</label>
                                </div>                          
                            
                            <!-- RADIO OPC -->
                            <br><p>Selección booleana (OPCIONAL):</p>
                                <div>
                                    <input type="radio" id="valorsi2" name="valorb2" value="Si" <?php 
                                    if(isset($_POST['valorb2']) && $_POST['valorb2'] == "Si"){ 

                                        echo 'checked';
                                          
                                    } 
                                ?>/>
                                    <label for="valorsi2">Sí</label>
                                </div>

                                <div>
                                    <input type="radio" id="valorno2" name="valorb2" value="No" <?php 
                                    if(isset($_POST['valorb2']) && $_POST['valorb2'] == "No"){ 

                                        echo 'checked';
                                          
                                    }
                                ?>/>
                                    <label for="valorno2">No</label>
                                </div>
                            
                            <!-- CHECKBOX OBL -->
                            <br><p>Checkbox obligatorio: </p>
                                <div>
                                    <input type="checkbox" id="primero" name="check[opcion1]" value="Elemento 1" 
                                        <?php 
                                        if(isset($_POST['check']['opcion1'])){
                                            echo 'checked';
                                        } ?>
                                    />
                                        <label for="primero">Elemento 1</label><br/>
                                        
                                    <input type="checkbox" id="segundo" name="check[opcion2]" value="Elemento 2" 
                                        <?php if(isset($_POST['check']['opcion2'])){
                                            echo 'checked';
                                        } ?>
                                    />
                                        <label for="segundo">Elemento 2</label><br/>
                                        
                                    <input type="checkbox" id="tercero" name="check[opcion3]" value="Elemento 3" 
                                        <?php if(isset($_POST['check']['opcion3'])){
                                            echo 'checked';
                                            
                                        } ?>
                                    /> 
                                        <label for="tercero">Elemento 3</label><br/>
                                </div>
                                <?php 
                                    //si hay error en este campo
                                    if ($aErrores['eCheck'] != NULL) {
                                        echo "<div class='errores'>".
                                            //se muestra dicho error
                                            $aErrores['eCheck']. 
                                        '</div>'; 
                                    }
                                ?>
                            
                            <!-- CHECKBOX OPC -->
                            <br><p>Checkbox opcional: </p>
                                <div>
                                    <input type="checkbox" id="primero2" name="check2[opcion1]" value="Elemento 1" 
                                        <?php 
                                        if(isset($_POST['check2']['opcion1'])){
                                            echo 'checked';
                                        } ?>
                                    />
                                        <label for="primero2">Elemento 1</label><br/>
                                        
                                    <input type="checkbox" id="segundo2" name="check2[opcion2]" value="Elemento 2" 
                                        <?php if(isset($_POST['check2']['opcion2'])){
                                            echo 'checked';
                                        } ?>
                                    />
                                        <label for="segundo2">Elemento 2</label><br/>
                                        
                                    <input type="checkbox" id="tercero2" name="check2[opcion3]" value="Elemento 3" 
                                        <?php if(isset($_POST['check2']['opcion3'])){
                                            echo 'checked';
                                            
                                        } ?>
                                    /> 
                                        <label for="tercero2">Elemento 3</label><br/>
                                </div>
                            <!-- LISTA -->
                            <br><p>Lista: </p>
                                <select name="lista"> 
                                    <option value="elemento1" 
                                        <?php if(isset($_POST['lista']) && $_POST['lista'] == "elemento1"){ 

                                                echo 'selected';
                                          
                                            } 
                                            ?>>Elemento 1</option>
                                    <option value="elemento2" 
                                            <?php if(isset($_POST['lista']) && $_POST['lista'] == "elemento2"){ 

                                                echo 'selected';
                                          
                                            } 
                                        ?>>Elemento 2</option>
                                    <option value="elemento3" 
                                            <?php if(isset($_POST['lista']) && $_POST['lista'] == "elemento3"){ 

                                                echo 'selected';
                                          
                                            } 
                                        ?>>Elemento 3</option>
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
                            <!-- FILE -->
                            <br><br><p>File: </p>
                            <label for="archivo">Introduce el archivo que quieras: </label><br>
                            <input name="archivo" type="file" value="fileupload" <?php 
                                //si no hay error y se ha insertado un valor en el campo con anterioridad
                                if($aErrores['eArchivo']== null && isset($_POST['archivo'])){ 

                                    //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                    //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                    echo $_POST['archivo'];   
                                } 
                            ?>/>
                            
                            <?php 
                                //si hay error en este campo
                                if ($aErrores['eArchivo'] != NULL) {
                                    echo "<div class='errores'>".
                                        //se muestra dicho error
                                        $aErrores['eArchivo']. 
                                    '</div>'; 
                                }
                            ?>
                            
                            <p>
                            <label for="color">Selección de color: </label>
                            <input type="color" name="color" value="<?php 
                                //si no hay error y se ha insertado un valor en el campo con anterioridad
                                if($aErrores['eColor']== null && isset($_POST['color'])){ 

                                    //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                    //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                    echo $_POST['color'];   
                                } 
                            ?>"/>
                        </p>                            
                            <?php 
                                //si hay error en este campo
                                if ($aErrores['eColor'] != NULL) {
                                    echo "<div class='errores'>".
                                        //se muestra dicho error
                                        $aErrores['eColor']. 
                                    '</div>'; 
                                }
                            ?>
                        <p>
                            <label for="tirador">Tirador (de 1 a 10): </label>
                            <input type="range" name="tirador" min="0" max="10" step="1" value="<?php 
                                //si no hay error y se ha insertado un valor en el campo con anterioridad
                                if($aErrores['eTirador']== null && isset($_POST['tirador'])){ 

                                    //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                    //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                    echo $_POST['tirador'];   
                                } 
                            ?>"/>
                        </p> 
                            
                        <p><input type="submit" name="enviar" value="Enviar" />
                    </fieldset>
                </form>
        <?php
            }
        ?>
       
    </body>
    
</html>       

