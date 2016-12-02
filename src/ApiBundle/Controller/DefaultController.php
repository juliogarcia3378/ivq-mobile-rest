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

    public function indexAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
                     $response['name']=$bc->getUser()->getProfile()->getFullname();
                     $response['avatar']=$bc->getUser()->getProfile()->getAvatar();
                     $response['title']=$bc->getTitle();
                     $response['category']=$bc->getCategory()->getName();
                     $response["address"]=$bc->getAddress()->getDescription();
                     $response['phone']=$bc->getPhone();
                     $response['email']=$bc->getEmail();
                     $response['fax']=$bc->getFax();
                     $response['website']=$bc->getWebsite();
                     $response['notes']=$bc->getNotes();
                     $response['company']=$bc->getCompany();
                     $response['about']=$bc->getAbout();
                     $response['logo']=$bc->getLogo();
                     $response['picture']=$bc->getPicture();


    		  return $this->render("@Api/Default/index.html.twig",$response);
    }

}
