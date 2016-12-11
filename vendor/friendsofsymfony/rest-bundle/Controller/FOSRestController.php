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
use Symfony\Component\HttpFoundation\JsonResponse;

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
    protected function getFileType()
    {
        if (
            ($_FILES["media"]["type"] == "video/mp4")
           || ($_FILES["media"]["type"] == "video/mpeg")
           || ($_FILES["media"]["type"] == "audio/wmv")
           || ($_FILES["media"]["type"] == "video/x-ms-wmv")
           || ($_FILES["media"]["type"] == "video/webm")
           || ($_FILES["media"]["type"] == "video/x-flv")
           || ($_FILES["media"]["type"] == "video/quicktime")
           || ($_FILES["media"]["type"] == "video/x-m4v")
           || ($_FILES["media"]["type"] == "video/x-matroska")
           )
            return "video";

        if (
            ($_FILES["media"]["type"] == "image/pjpeg")
           || ($_FILES["media"]["type"] == "image/gif")
           || ($_FILES["media"]["type"] == "image/png")
           || ($_FILES["media"]["type"] == "image/jpeg")
           || ($_FILES["media"]["type"] == "image/bmp")
           || ($_FILES["media"]["type"] == "image/gif")
           || ($_FILES["media"]["type"] == "image/vnd.microsoft.icon")
           || ($_FILES["media"]["type"] == "image/tiff")
           || ($_FILES["media"]["type"] == "image/svg+xml")
           )
             return "picture";
       return false;
            
    }
    protected function uploadPicture($index, $uploaddir){
        
        $array = explode(".", $_FILES[$index]["name"]);
       
     $file = date('Ymdhhmmss').uniqid().".".$array[count($array)-1]; 
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
          $file = date('Ymdhhmmss').uniqid().".".$array[count($array)-1];      
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
