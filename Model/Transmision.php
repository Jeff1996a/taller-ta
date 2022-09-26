<?php


class Transmision
{
    public $id_transmision;
    public $ubicacion;
    public $id_tecnico;
    public $unidad_movil;
    public $fecha_inicio;
    public $fecha_fin;
    public $observaciones;
    public $adjuntos;

    function __construct()
    {
        $this-> id_transmision = 0;
        $this-> ubicacion = "";
        $this-> id_tecnico = 0;
        $this-> unidad_movil = "";
        $this-> equipo = "";
        $this-> fecha_inicio = NULL;
        $this-> fecha_fin = NULL;
        $this-> observaciones = "";
        $this-> adjuntos = NULL;
    }
}