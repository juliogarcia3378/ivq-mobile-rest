<?php

/*
 * This file is part of the FOSRestBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestBundle\Controller;

use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controllers using the View functionality of FOSRestBundle.
 *
 * @author Lukas Kahwe Smith <smith@pooteeweet.org>
 */
abstract class FOSRestController extends Controller
{
    use ControllerTrait;

    protected function sortFunction( $a, $b ) {
    return strtotime($a["date"]) - strtotime($b["date"]);
}
     
    protected function uploadPicture($index, $uploaddir){
        $array = explode(".", $_FILES[$index]["name"]);
     $file = date('Ymdhhmmss').".".$array[1];              
        if ($file!=null){
                if($_SERVER['REQUEST_METHOD']=='POST'){
            $base = $this->getParameter('base_directory');
            $path = $base.$uploaddir . basename($file);
            move_uploaded_file($_FILES[$index]['tmp_name'], $path);
            $file= $this->getRequest()->getUriForPath($uploaddir.$file);
                                         $file = str_replace("/app.php", "", $file);
                                         $file = str_replace("/app_dev.php", "", $file);
                                         return $file;
                            }
                 }
                 return null;
    }

        protected function uploadFile($index, $uploaddir){
        $array = explode(".", $_FILES[$index]["name"]);
          $file = date('Ymdhhmmss').".".$array[1];              
             if ($file!=null){
                if($_SERVER['REQUEST_METHOD']=='POST'){
            $base = $this->getParameter('base_directory');
            $path = $base.$uploaddir . basename($file);
            move_uploaded_file($_FILES[$index]['tmp_name'], $path);
            $file= $this->getRequest()->getUriForPath($uploaddir.$file);
                                         $file = str_replace("/app.php", "", $file);
                                         $file = str_replace("/app_dev.php", "", $file);
                                         return $file;
                            }
                 }
                 return null;
    }

    /**
     * Get the ViewHandler.
     *
     * @return ViewHandlerInterface
     */
    protected function getViewHandler()
    {
        if (!$this->viewhandler instanceof ViewHandlerInterface) {
            $this->viewhandler = $this->container->get('fos_rest.view_handler');
        }

        return $this->viewhandler;
    }
}
