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
use ApiBundle\Repository\GroupCategoryRepository;


class CategoryController extends FOSRestController
{

     /**
     * @Route("/category/list")
     * @Rest\Get("/category/list")
     * @ApiDoc(
     *  section = "Category",
     *  description="Return the list of categories",
     * )
     */
      public function listCategoriesAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $categories = $em->getRepository("AppBundle:GroupCategory")->createQueryBuilder('c')
               ->select('c')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            return new JsonResponse(array( "categories"=>$categories));
        }




     
 }