<?php
/**
 * Created by PhpStorm.
 * User: natche
 * Date: 22/02/2017
 * Time: 16:51
 */

namespace HealthCheckBundle\Model;


class HealthCheckManager
{
    private $mysqlCheck;

    public $checks = ['mysqlCheck'];

    public function __construct(MysqlCheck $mysqlCheck)
    {
        $this->mysqlCheck = $mysqlCheck;
    }

    public function performCheck()
    {
        $results = [];

        foreach($this->checks as $check) {
            if(property_exists($this, $check) && $this->{$check} instanceof HealthCheckInterface) {
                $results[$this->{$check}->getName()] = $this->{$check}->check();
            }
        }

        return $results;
    }

}