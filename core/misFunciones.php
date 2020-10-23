<?php
require_once '201020libreriaValidacion.php';

  function comprobarColorHexadecimal($cadena, $obligatorio = 0){
            $patron_texto = "((#)[0-9a-fA-F]{6})";
            $mensajeError = null;

            //Si es olbigatorio se comprueba si está vacío, si no es obligatorio, no es necesario
            if ($obligatorio == 1) {
                $mensajeError = validacionFormularios::comprobarNoVacio($cadena);
            }

            if (!preg_match($patron_texto, $cadena) && !empty($cadena)) {
                $mensajeError = " Solo se admite código hexadecimal.";
            }

            return $mensajeError;
        }

    function SumaNumeros (float $numero1, float $numero2){
        $resultado = $numero1+$numero2;

        return $resultado;
    }

    function RestaNumeros (float $numero1, float $numero2){
        $resultado = $numero1-$numero2;

        return $resultado;
    }

    function MultNumeros (float $numero1, float $numero2){
        $resultado = $numero1*$numero2;

        return $resultado;
    }

    function DivNumeros (float $numero1, float $numero2){
        $resultado = $numero1/$numero2;

        return $resultado;
    }

    function ModuloNumeros (float $numero1, float $numero2){
        $resultado = $numero1%$numero2;

        return $resultado;
    }
?>

