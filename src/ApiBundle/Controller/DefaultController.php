<?php


namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
 use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
class DefaultController extends FOSRestController
{

    public function indexAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
    	if ($this->get('security.context')->isGranted('ROLE_ADMIN') === FALSE) {
    		$view = $this->view(array(
            'user' => 'usser'), Response::HTTP_OK);
        return $view;
        }

$view = $this->view(array(
            'user' => 'ussdfsder'), Response::HTTP_OK);
        return $view;
    }
}
