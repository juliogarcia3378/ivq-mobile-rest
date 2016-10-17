<?php

// src/Acme/ApiBundle/Controller/DemoController.php

namespace ApiBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;

class DemoController extends FOSRestController
{

    public function getDemosAction()
    {

        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }
}