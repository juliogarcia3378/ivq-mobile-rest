<?php


namespace Acme\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
 use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
class DefaultController extends Controller
{
    /**
     * @Route("/hello")
     * @Rest\Get("/hello")
     * @ApiDoc(
     *  description="Returns a collection of Object",
     *  requirements={
     *      {
     *          "name"="limit",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="how many objects to return"
     *      }
     *  },
     *  parameters={
     *      {"name"="categoryId", "dataType"="integer", "required"=true, "description"="category id"}
     *  }
     * )
     */
    public function indexAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
    	if ($this->get('security.context')->isGranted('ROLE_ADMIN') === FALSE) {
    		return new JSONResponse("Access Denied");
            //throw new AccessDeniedException();
        }

$view = $this->view(array(
            'last_username' => $lastUsername,
            'action'=>'rest/web/app_dev.php/login_check',
            'error' => $error,
            'csrf_token' => $csrfToken), Response::HTTP_OK);
        return $view;
        return $this->render('ApiBundle:Default:index.html.twig');
    }
}
