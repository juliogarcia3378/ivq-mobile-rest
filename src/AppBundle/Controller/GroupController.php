<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Security\Core\Exception\AccessDeniedException;
 use Symfony\Component\Security\Core\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Core\ComunBundle\Util\UtilRepository2;


class GroupController extends FOSRestController
{

     /**
     * @Route("/group/list")
     * @Rest\Get("/group/list")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return the list of groups by filters provided",
      *  requirements={
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"="First Element"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      }
     *              }
     * )
     */
      public function listGroupsAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $array = array();
            
            $groups = $em->getRepository("AppBundle:Groups")->obtenerTodos($array);
             $total = count($em->getRepository("AppBundle:Groups")->findAll());
              $array = array();
              $i=0;
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getEmail();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }


            $pagination= UtilRepository2::paginate();
            return new JsonResponse(array("pagination"=>$pagination,"groups"=>$array));
        }

 }