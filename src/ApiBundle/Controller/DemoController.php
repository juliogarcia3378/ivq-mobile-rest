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
         if($_SERVER['REQUEST_METHOD']=='POST'){
         //Getting actual file name
         $name = $_FILES['photo']['name'];
         
         //Getting temporary file name stored in php tmp folder 
         $tmp_name = $_FILES['photo']['tmp_name'];
         
         //Path to store files on server
         $path = 'uploads/';
         
         //checking file available or not 
         if(!empty($name)){
         //Moving file to temporary location to upload path 
         move_uploaded_file($tmp_name,$path.$name);
         
         //Displaying success message 
         echo "Upload successfully";
         }else{
         //If file not selected displaying a message to choose a file 
         echo "Please choose a file";
         }
            }
             return new JsonResponse(array( "message"=>"You haven't permissions for view this broadcast."));
        }
}