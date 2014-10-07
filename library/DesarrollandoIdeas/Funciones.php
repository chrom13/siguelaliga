<?php

class DesarrollandoIdeas_Funciones
{
    /**
     * Función que da formato a una fecha
     *
     * @param string $fecha (YYYY-MM-DD)
     * @return string $fechaFinal (DD/MES/YYYY)
     */
    public function darFormatoFecha($fecha)
    {
        
    }

    /**
     * Función que quita el formato a una fecha
     *
     * @param string $fecha (DD/MES/YYYY)
     * @return string $fechaFinal (YYYY-MM-DD)
     */
    public function quitarFormatoFecha($fecha)
    {
        
    }

    /**
     * Función que forma una url amigable a partir de una criterio
     *
     * @param string $criterio
     * @return string $urlAmigable
     */
    public function urlAmigable($criterio)
    {
        // Cambiamos el título a minúsculas
        $criterio = mb_strtolower($criterio, 'UTF-8');

        // Remplazamos los caracteres especiales
        $caracteresEspeciales = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $caracteresPermitidos = array('a', 'e', 'i', 'o', 'u', 'n');

        $criterio = str_replace($caracteresEspeciales, $caracteresPermitidos, $criterio);

        // Añadimos los guiones
        $caracteresEspeciales = array(' ', '&', '\r\n', '\n', '+');
        $url = str_replace($caracteresEspeciales, '-', $criterio);

        // Eliminamos y remplazamos otros caracteres especiales
        $caracteresEspeciales = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $caracteresPermitidos = array('', '-', '');

        $url = preg_replace($caracteresEspeciales, $caracteresPermitidos, $url);

        return $url;
    }
}