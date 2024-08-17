<?php

require_once 'Sanitize.class.php';
abstract Class  SanitizeCustom extends SanitizeVars{

    public static function id($integer, $min='', $max=''){
        $int = intval($integer);
        if((($min != '') && ($int < $min)) || (($max != '') && ($int > $max)))
        return false;

        return $int;
    }


    public static function Nombres($string, $min='', $max=''){
        $string = preg_replace("/[^a-zA-ZñÑ]/", "", $string);
        $len = strlen($string);
        if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
        return FALSE;
        return $string;

    }

    public static function Apellidos($string, $min='', $max=''){
        $string = preg_replace("/[^a-zA-ZñÑ]/", "", $string);
        $len = strlen($string);
        if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
        return FALSE;
        return $string;

    }
    public static function Telefono($string, $max = 12) {
        // Limpieza de la cadena de entrada
        $string = preg_replace("/[^\d]/", "", $string); // Eliminar todo excepto dígitos
        $string = substr($string, 0, $max); // Truncar la cadena a la longitud máxima permitida
    
        // Verificar si la longitud de la cadena excede el máximo permitido
        if (strlen($string) > $max) {
            return FALSE; // La longitud del número de teléfono excede el máximo permitido
        }
    
        return $string; // Devolver el número de teléfono limpio
    }
    

    public static function Biografia($string, $min='', $max=''){
        $string = preg_replace("/[^a-zA-Z0-9 ñÑ.@]/", "", $string);
        $len = strlen($string);
        if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
        return FALSE;

        return $string;
    }

    public static function Email($string){
        if (preg_match("/^[^0-9][a-zA-ZñÑ0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$string)) {
            $len = strlen($string);
            return $string;
        }
        return FALSE;
    }

    public static function Redes($string, $min='', $max=''){
        $string = preg_replace("/^[^0-9][a-zA-ZñÑ0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", "", $string);
        $len = strlen($string);
        if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
        return FALSE;

        return $string;
    }

    public static function Url($url, $min = '', $max = '') {
        // Eliminar espacios en blanco al principio y al final de la URL
        $url = trim($url);
        
        // Expresión regular para validar una URL
        $pattern = '/^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/i';
    
        // Validar la URL con la expresión regular
        if (!preg_match($pattern, $url)) {
            return FALSE; // La URL no coincide con el patrón
        }
    
        // Calcular la longitud de la URL
        $len = strlen($url);
    
        // Verificar si la longitud está dentro de los límites especificados
        if (($min !== '' && $len < $min) || ($max !== '' && $len > $max)) {
            return FALSE; // La longitud de la URL no cumple con los requisitos
        }
    
        // La URL es válida, devolverla
        return $url;
    }


}

?>