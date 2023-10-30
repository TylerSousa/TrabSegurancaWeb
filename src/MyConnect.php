<?php

class MyConnect
{
    private static $instance = null;
    private $connection = null;

    private function __construct()
    {
        $config = parse_ini_file('.config');

        // aqui dentro é que se faz a coisa demorada
        $this->connection = new \mysqli(
            $config['HOSTNAME'],
            $config['USERNAME'],
            $config['PASSWORD'],
            $config['DBNAME'],
            $config['DBPORT'],
        );
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new MyConnect();
        }

        return self::$instance->getConnection();
    }

    /**
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
}