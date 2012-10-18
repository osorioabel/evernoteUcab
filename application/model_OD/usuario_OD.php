<?php

class Usuario_OD {

    private $username = '';
    private $password = '';
    private $email = '';
    private $oauth_token = '';
    private $oauth_token_secret = '';
    private $name = '';
    private $apellido = '';

 public function __construct($username, $password, $email, $oauth_token, $oauth_token_secret, $name, $apellido) {

        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->oauth_token = $oauth_token;
        $this->oauth_token_secret = $oauth_token_secret;
        $this->name = $name;
        $this->apellido = $apellido;
    }

    public function Usuario_OD() {
        $this->username = '';
        $this->password = '';
        $this->email = '';
        $this->oauth_token = '';
        $this->oauth_token_secret = '';
        $this->name = '';
        $this->apellido = '';
    }

   public static function token_OD($username,$oauth_token, $oauth_token_secret) {

       $this->username = $username;
       $this->oauth_token = $oauth_token;
        $this->oauth_token_secret = $oauth_token_secret;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getOauth_token() {
        return $this->oauth_token;
    }

    public function setOauth_token($oauth_token) {
        $this->oauth_token = $oauth_token;
    }

    public function getOauth_token_secret() {
        return $this->oauth_token_secret;
    }

    public function setOauth_token_secret($oauth_token_secret) {
        $this->oauth_token_secret = $oauth_token_secret;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }



}

