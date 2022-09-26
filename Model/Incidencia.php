<?php


class Incidencia
{
    public $id_incidencia;
    public $quien_reporta;
    public $id_responsable;
    public $fecha_soporte;
    public $fecha_solucion;
    public $estado_incidencia;
    public $fecha_fin;
    public $adjuntos;
    public $id_tecnico;

    function __construct()
    {
        $this->id_incidencia = 0;
        $this->quien_reporta = "";
        $this->id_responsable = 0;
        $this-> fecha_soporte = NULL;
        $this-> fecha_solucion = NULL;
        $this-> estado_incidencia = "";
        $this-> fecha_fin = "";
        $this-> adjuntos = NULL;
        $this-> id_tecnico = 0;
    }

}