<?php
/**
 * Created by PhpStorm.
 * User: natche
 * Date: 18/02/2017
 * Time: 12:43
 */

namespace HealthCheckBundle\Model;


interface HealthCheckInterface
{
    public function getName();

    public function check();
}