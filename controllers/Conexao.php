<?php
    class Conexao{
        private $host;
        private $user;
        private $pass;
        private $bd;

        public function __construct($h, $u, $p, $banco){
            $this->host=$h;
            $this->user=$u;
            $this->pass=$p;
            $this->bd=$banco;

        }

        public function conectar(){
            $conn = new mysqli($this->host,$this->user,$this->pass,$this->bd);
            return $conn;


    }


    }
?>