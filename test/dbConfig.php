<?php

class DbConfig
{
    protected $serverName;
    protected $userName;
    protected $password;
    protected $dbName;
    public function dbConfig()
    {
        $this -> serverName = 'localhost';
        $this -> userName = 'root';
        $this -> password = '';
        $this -> dbName = 'tas';
    }
}
