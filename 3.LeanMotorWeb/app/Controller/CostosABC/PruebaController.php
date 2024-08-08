<?php

class PruebaController {
    
    var $nombre;
    var $edad;
    
    function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
    
    
    function getNombre() {
        return $this->nombre;
    }

    function getEdad() {
        return $this->edad;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    
    function SumarEdad($edad)
    {
        $Nedad=$edad+10;
        return $Nedad;
    }
    function SumarEdad2($Nedad)
    {
        $N2edad=$Nedad+20;
        return $N2edad;
    }
    
}
