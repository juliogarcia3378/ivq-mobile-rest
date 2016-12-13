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
    protected function getFileType($index="media")
    {
        if (
              ($_FILES[$index]["type"] == "video/mp4")
           || ($_FILES[$index]["type"] == "video/mpeg")
           || ($_FILES[$index]["type"] == "audio/wmv")
           || ($_FILES[$index]["type"] == "video/x-ms-wmv")
           || ($_FILES[$index]["type"] == "video/webm")
           || ($_FILES[$index]["type"] == "video/x-flv")
           || ($_FILES[$index]["type"] == "video/quicktime")
           || ($_FILES[$index]["type"] == "video/x-m4v")
           || ($_FILES[$index]["type"] == "video/x-matroska")
           )
            return "video";

        if (
            ($_FILES[$index]["type"] == "image/pjpeg")
           || ($_FILES[$index]["type"] == "image/gif")
           || ($_FILES[$index]["type"] == "image/png")
           || ($_FILES[$index]["type"] == "image/jpeg")
           || ($_FILES[$index]["type"] == "image/bmp")
           || ($_FILES[$index]["type"] == "image/gif")
           || ($_FILES[$index]["type"] == "image/vnd.microsoft.icon")
           || ($_FILES[$index]["type"] == "image/tiff")
           || ($_FILES[$index]["type"] == "image/svg+xml")
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

    protected function copyFile($address){
      $array = explode(".", $address);

      $base = $this->getParameter('base_directory');
      $uploaddir = $this->getParameter('saved_business_card_directory');
      $file = date('Ymdhhmmss').uniqid().".".$array[count($array)-1];

      $dest = $base.$uploaddir .basename($file);
      copy($address, $dest);

      $file= $this->getRequest()->getUriForPath($uploaddir.$file);
                                         $file = str_replace("/app.php", "", $file);
                                         $file = str_replace("/app_dev.php", "", $file);
                                         return $file;

      return $dest;



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
