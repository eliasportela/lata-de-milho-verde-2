<?php
    class db{
        // Properties
        private $dbhost = 'localhost'; //Local do HOST do banco de dados
        private $dbuser = 'root'; //Usuário do banco
        private $dbpass = 'root'; //Senha do banco
        private $dbname = 'spin'; //Nome do banco

        // Connect
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=utf8";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }