<?php

interface Usuario_DAO {

    public function login($username, $password);

    public function register($name, $lastname, $username, $email, $password);

    public function modificar($username, $nombre, $apellido, $email);

    public function cambiarClave($username, $password);

    public function configuarDropbox($username, $cuentadropbox, $passdropbox);
    public function updatetoken(Usuario_OD $usuario);
    
}
