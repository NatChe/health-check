<?php
/**
 * Created by PhpStorm.
 * User: natche
 * Date: 18/02/2017
 * Time: 11:19
 */

namespace HealthCheckBundle\Model;

use Monolog\Logger;

class MysqlCheck implements HealthCheckInterface
{
    const MYSQL_HEALTH_CHECK_NAME = 'mysql';

    private $host;

    private $user;

    private $password;

    private $port;

    private $logger;

    private $name;

    public function __construct($host, $user, $password, $port, $name, Logger $logger)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
        $this->logger = $logger;
        $this->name = $name;
    }

    public function getName()
    {
        return self::MYSQL_HEALTH_CHECK_NAME;
    }

    public function check()
    {
        try {

            //if no database is set, just check mysql connection
            if(is_null($this->name)) {
                $connection_string = sprintf('mysql:host=%s;', $this->host);
            }
            else {
                $connection_string = sprintf('mysql:host=%s;dbname=%s', $this->host, $this->name);
            }

            $db = new \PDO($connection_string, $this->user, $this->password,
                    array(
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ));

            return true;

        } catch(\PDOException $pe){
                $this->logger->error($pe->getMessage());
                return false;
            }
    }
}