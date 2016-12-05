<?php

// src/Acme/ApiBundle/Controller/DemoController.php

namespace ApiBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Zippopotamus\Service\Zippopotamus;

class DemoController extends FOSRestController
{

      /**
    * @param Request $request
     * @Route("/testing")
     * @Rest\Get("/testing")
     * @ApiDoc(
     *  section = "Testing",
     *  description="*** This API Call is just for testing ",
     * )
     */
    public function getDemosAction()
    {
        shell_exec('wkhtmltoimage http://www.forosdelweb.com julio.png');  

        
             return new JsonResponse(array( "message"=>"You haven't permissions for view this broadcast."));
        }



        /* $avatar = $_FILES["avatar"]["name"];              
                         if ($avatar!=null){
                                     if($_SERVER['REQUEST_METHOD']=='POST'){
                      $uploaddir = '/var/www/html/IVQRest/web/uploads/profile/';
            $uploadfile = $uploaddir . basename($_FILES['avatar']['name']);

            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);



            $avatar= $this->getRequest()->getUriForPath('/uploads/profile/'.$_FILES['avatar']['name']);
                                         $avatar = str_replace("/app.php", "", $avatar);
                                         $avatar = str_replace("/app_dev.php", "", $avatar);
                                         $profile->setAvatar($avatar);
                            }
                 }*/
}