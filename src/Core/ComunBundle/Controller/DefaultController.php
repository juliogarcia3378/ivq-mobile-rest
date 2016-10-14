<?php

namespace Core\ComunBundle\Controller;


class DefaultController extends BaseController
{
   

    public function readAction()
    {

     $em = $this->getDoctrine()->getEntityManager();

     $groups = $em->getRepository('IVQAdminBundle:MyGroups')->findAll();
     $admins = $em->getRepository('MySecurityBundle:Users')->listAllAdmin();

        $foto = null;
        if($this->getUser() && $this->getUser()->getProfile() )
            $foto = $this->getUser()->getProfile()->getAvatar();

    $foto ="http://www.misimagenesde.com/wp-content/uploads/2009/02/fotos-de-perfil.jpg";
        return $this->render('@Comun/Default/index.html.twig',
        	array(
        		'foto'=>$foto,
        		'groups'=>count($groups),
        		'admin'=>count($admins)
        		));
    }


}
