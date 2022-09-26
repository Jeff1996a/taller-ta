<?php


class Usuario
{
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $nickname;
    public $password;
    public $rol;
    public $lastlogin;

    function __construct()
    {
        $this-> id_usuario = 0;
        $this-> nombre = "";
        $this-> apellido = "";
        $this-> email ="";
        $this-> nickname = "";
        $this-> password = "";
        $this-> rol = "";
        $this-> lastlogin = NULL;
    }
}