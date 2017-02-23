<?php
/**
 * Created by PhpStorm.
 * User: natche
 * Date: 18/02/2017
 * Time: 11:00
 */

namespace HealthCheckBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/healthcheck", name="healthcheck")
     */
    public function showAction()
    {
        $hc = $this->get('health_check.manager');

        $data = $hc->performCheck();

        return new JsonResponse($data);
    }
}